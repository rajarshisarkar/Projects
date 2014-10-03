import com.mongodb.MongoClient;
import com.mongodb.DB;
import com.mongodb.DBCollection;
import com.mongodb.BasicDBObject;
import com.mongodb.DBObject;
import com.mongodb.DBCursor;
import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.*;

public class edx_to_moodle_send_pdf {
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
    static final String DB_URL = "jdbc:mysql://localhost/moodle";
    static final String USER = "root";
    static final String PASS = "root";
    public static void main(String[] args) throws ClassNotFoundException, IOException, SQLException, NoSuchAlgorithmException {
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = null;
        conn = DriverManager.getConnection(DB_URL, USER, PASS);
        Statement stmt = conn.createStatement(); //mysql statement
        //To connect to mongodb server
        MongoClient mongoClient = new MongoClient("localhost", 27017);
        //Now connect to your databases
        DB db = mongoClient.getDB("xcontent");
        DBCollection coll = db.getCollection("fs.files");
        BasicDBObject query = new BasicDBObject("_id.category", "asset").append("_id.tag", "c4x");
        DBCursor cursor = coll.find(query);
        String result = "", resultcopy = "";
        while (cursor.hasNext()) {
            DBObject tobj = cursor.next();
            result = tobj.get("_id").toString();
            resultcopy = result;
        }
        String[] temp1 = result.split(":");
        String resa = temp1[3];
        String[] resb = resa.split(",");
        String resc = resb[0];
        String resd = resc.substring(2, resc.length() - 2);
        System.out.println(resd);
        String[] temp2 = resultcopy.split(":");
        String rese = temp2[5];
        String[] resf = rese.split(",");
        String resg = resf[0];
        String resh = resg.substring(2, resg.length() - 2);
        System.out.println(resh);
        cursor.close();
        String line;
        Process p = Runtime.getRuntime().exec(new String[] {
            "/bin/bash", "-c", "php /home/rajarshi/edx_to_moodle_synchronisation/pdf_transfer/contenthash.php"
        });
        BufferedReader input = new BufferedReader(new InputStreamReader(p.getInputStream()));
        String contenthash = "";
        while ((line = input.readLine()) != null) {
            contenthash = line;
        }
        input.close();
        System.out.println(contenthash);
        String subdirectory1 = contenthash.substring(0, 2);
        String subdirectory2 = contenthash.substring(2, 4);
        int contextId = 57;
        String component = "mod_resource";
        String filearea = "content";
        int itemid = (int)(Math.random() * 1000000000);
        String filepath = "/";
        int userid = 2;
        String filepathforsize = "/var/moodledata/filedir/" + subdirectory1 + "/" + subdirectory2 + "/" + contenthash;
        System.out.println(filepathforsize);
        long filesize = getFileSize(filepathforsize);
        String extension = resh.substring(resh.length() - 3, resh.length());
        String mimetype = "application/" + extension;
        System.out.println(filesize);
        String inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + resh;
        String sourcename = "";
        String pathnamehash = "";
        try {
            pathnamehash = sha1(inputforpathhash);
        } catch (NoSuchAlgorithmException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        }
        //to prevent duplicate insertion of pdf
        int flag = 1;
        String sql = "select * from mdl_files where contenthash=" + "'" + contenthash + "'";
        ResultSet rs = stmt.executeQuery(sql);
        int contxtid = 0;
        while (rs.next()) {
            contxtid = rs.getInt("contextid");
        }
        if (contxtid != 0) {
            sql = "select * from mdl_context where id=" + contxtid;
            rs = stmt.executeQuery(sql);
            String path = "";
            while (rs.next()) {
                path = rs.getString("path");
            }
            //System.out.println(path);
            String[] temp = path.split("/");
            int idtomatch = Integer.parseInt(temp[3]);
            sql = "select * from mdl_context where id=" + idtomatch;
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                idtomatch = rs.getInt("instanceid");
            }
            sql = "select * from mdl_course where idnumber=" + "'" + resd + "'";
            rs = stmt.executeQuery(sql);
            int id = 0;
            while (rs.next()) {
                id = rs.getInt("id");
            }
            if (idtomatch == id) {
                flag = 0;
            }
        }
        //end of prevent duplicate
        //for mdl_file part 1..................................
        if (flag == 1) {
            contextId = 5;
            component = "user";
            filearea = "draft";
            itemid = (int)(Math.random() * 1000000000);
            inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + resh;
            pathnamehash = sha1(inputforpathhash);
            sourcename = "O:8:\"stdClass\":1:{s:6:\"source\";s:38:\"" + resh + "\";}";
            sql = "Insert into mdl_files (contenthash,pathnamehash,contextid,component,filearea,itemid,filepath,filename,userid,filesize,mimetype,status,source,author,license,timecreated,timemodified,sortorder)" + "values ('" + contenthash + "','" + pathnamehash + "','" + contextId + "','" + component + "','" + filearea + "','" + itemid + "','" + filepath + "','" + resh + "',2,'" + filesize + "','" + mimetype + "',0,'" + sourcename + "','Rajarshi Sarkar','allrightsreserved',0,0,0)";
            stmt.execute(sql);
            inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + ".";
            pathnamehash = sha1(inputforpathhash);
            sql = "Insert into mdl_files (contenthash,pathnamehash,contextid,component,filearea,itemid,filepath,filename,userid,filesize,status,timecreated,timemodified,sortorder)" + "values ('da39a3ee5e6b4b0d3255bfef95601890afd80709','" + pathnamehash + "','" + contextId + "','" + component + "','" + filearea + "','" + itemid + "','" + filepath + "','.',2,0,0,0,0,0)";
            stmt.execute(sql);
            //end of mdl_file part1.....................................................................
            //for mdl_context.................................
            String test = "select * from mdl_course";
            rs = stmt.executeQuery(test);
            int courseid = 0;
            String coursenumber = "";
            while (rs.next()) {
                courseid = rs.getInt("id");
                coursenumber = rs.getString("idnumber");
                if (coursenumber.compareTo(resd) == 0) break;
            }
            String test1 = "select * from mdl_context where instanceid=" + courseid + " and contextlevel=50";
            int idagainstinstanceid = 0;
            rs = stmt.executeQuery(test1);
            while (rs.next()) {
                idagainstinstanceid = rs.getInt("id");
            }
            System.out.println(idagainstinstanceid);
            int instanceidcontent = 0;
            test1 = "select * from mdl_context where contextlevel=70";
            rs = stmt.executeQuery(test1);
            while (rs.next()) {
                instanceidcontent = rs.getInt("instanceid");
            }
            instanceidcontent++;
            String path_for_mdl_context = "/1/3/" + Integer.toString(idagainstinstanceid) + "/";
            test1 = "insert into mdl_context (contextlevel, instanceid, path, depth)" + " values(70,'" + instanceidcontent + "','" + path_for_mdl_context + "',4)";
            System.out.println(test1);
            stmt.execute(test1);
            rs = stmt.executeQuery("select * from mdl_context where id =(select max(id) from mdl_context)");
            int idforpath = 0;
            while (rs.next()) {
                idforpath = rs.getInt("id");
            }
            path_for_mdl_context = "'/1/3/" + Integer.toString(idagainstinstanceid) + "/" + Integer.toString(idforpath) + "'";
            System.out.println(path_for_mdl_context);
            rs = stmt.executeQuery("select * from mdl_context");
            int lastidfromcontexttable = 0;
            while (rs.next()) {
                lastidfromcontexttable = rs.getInt("id");
            }
            test1 = "update mdl_context set path =" + path_for_mdl_context + " where id =" + Integer.toString(lastidfromcontexttable);
            System.out.println(test1);
            stmt.execute(test1);
            //end of mdl_context.....................
            //for mdl_file part 2...........................
            contextId = idforpath;
            component = "mod_resource";
            filearea = "content";
            itemid = 0;
            inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + resh;
            System.out.println(inputforpathhash);
            pathnamehash = sha1(inputforpathhash);
            sql = "Insert into mdl_files (contenthash,pathnamehash,contextid,component,filearea,itemid,filepath,filename,userid,filesize,mimetype,status,source,author,license,timecreated,timemodified,sortorder)" + "values ('" + contenthash + "','" + pathnamehash + "','" + contextId + "','" + component + "','" + filearea + "','" + itemid + "','" + filepath + "','" + resh + "',2,'" + filesize + "','" + mimetype + "',0,'" + resh + "','Rajarshi Sarkar','allrightsreserved',0,0,1)";
            stmt.execute(sql);
            inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + ".";
            System.out.println(inputforpathhash);
            pathnamehash = sha1(inputforpathhash);
            sql = "Insert into mdl_files (contenthash,pathnamehash,contextid,component,filearea,itemid,filepath,filename,userid,filesize,status,timecreated,timemodified,sortorder)" + "values ('da39a3ee5e6b4b0d3255bfef95601890afd80709','" + pathnamehash + "','" + contextId + "','" + component + "','" + filearea + "','" + itemid + "','" + filepath + "','.',2,0,0,0,0,0)";
            stmt.execute(sql);
            // end of mdl_files part 2..................................................................
            //for mdl_resource..............................................................
            rs = stmt.executeQuery("select displayoptions from mdl_resource where id=(select max(id) from mdl_resource)");
            String displayoptions = "";
            while (rs.next()) {
                displayoptions = (String) rs.getString("displayoptions").toString();
            }
            sql = "insert into mdl_resource (course,name,intro,introformat,tobemigrated,legacyfiles,display,displayoptions,filterfiles,revision,timemodified)" + "values ('" + courseid + "','" + resh.substring(0, resh.length() - 4) + "','<p>No description</p>',1,0,0,0,'" + displayoptions + "',0,1,0)";
            System.out.println(sql);
            stmt.execute(sql);
            //end of mdl_resource......................................................... 
            //for mdl_course_sections 
            int idforsequence = 0;
            sql = "select * from mdl_context where contextlevel=70 and id=(select max(id) from mdl_context)";
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                idforsequence = rs.getInt("instanceid");
            }
            int section = 0;
            String sequence = "";
            sql = "select * from mdl_course_sections where course=" + courseid + " and section=0";
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                section = rs.getInt("id");
                sequence = rs.getString("sequence");
            }
            String temptocompare = "";
            if (sequence.compareTo(temptocompare) == 0) {
                sequence = Integer.toString(idforsequence);
            } else {
                sequence = sequence + "," + Integer.toString(idforsequence);
            }
            sql = "update mdl_course_sections set sequence=" + "'" + sequence + "'" + " where id=" + section;
            stmt.execute(sql);
            //end of mdl_course_sections................................................
            //start of mdl_course_modules...............................................
            int instanceid = 0;
            sql = "select * from mdl_course_modules where module=17";
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                instanceid = rs.getInt("instance");
            }
            instanceid++;
            sql = "insert into mdl_course_modules(course,module,instance,section,added,score,indent,visible,visibleold,groupmode,groupingid,groupmembersonly,completion,completionview,completionexpected,availablefrom,availableuntil,showavailability,showdescription)" + " values('" + courseid + "',17,'" + instanceid + "','" + section + "',0,0,0,1,1,0,0,0,0,0,0,0,0,0,0)";
            System.out.println(sql);
            stmt.execute(sql);
            //end of mdl_course_modules.............................................................
        }
    }
    public static long getFileSize(String filename) {
        File file = new File(filename);
        if (!file.exists() || !file.isFile()) {
            System.out.println("File doesn\'t exist");
            return -1;
        }
        return file.length();
    }
    static String sha1(String input) throws NoSuchAlgorithmException {
        MessageDigest mDigest = MessageDigest.getInstance("SHA1");
        byte[] result = mDigest.digest(input.getBytes());
        StringBuffer sb = new StringBuffer();
        for (int i = 0; i < result.length; i++) {
            sb.append(Integer.toString((result[i] & 0xff) + 0x100, 16).substring(1));
        }
        return sb.toString();
    }
}