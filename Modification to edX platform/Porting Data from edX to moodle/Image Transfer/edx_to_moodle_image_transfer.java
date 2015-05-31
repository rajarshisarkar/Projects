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
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.sql.*;
import javax.activation.MimetypesFileTypeMap;

public class edx_to_moodle_image_transfer {
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
    static final String DB_URL = "jdbc:mysql://localhost/moodle";
    static final String USER = "root";
    static final String PASS = "root";
    public static void main(String[] args) throws ClassNotFoundException, IOException, SQLException, NoSuchAlgorithmException {
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = null;
        Connection conn1 = null;
        Connection conn2 = null;
        conn = DriverManager.getConnection(DB_URL, USER, PASS);
        conn1 = DriverManager.getConnection(DB_URL, USER, PASS);
        conn2 = DriverManager.getConnection(DB_URL, USER, PASS);
        Statement stmt = conn.createStatement(); //mysql statement
        Statement stmt1 = conn1.createStatement(); //mysql statement
        Statement stmt2 = conn2.createStatement(); //mysql statement
        //To connect to mongodb server
        MongoClient mongoClient = new MongoClient("localhost", 27017);
        //Now connect to your databases
        DB db = mongoClient.getDB("xmodule");
        DBCollection coll = db.getCollection("modulestore");
        String image_description_to_be_sent = "";
        BasicDBObject query = new BasicDBObject("_id.category", "html").append("metadata.display_name", "Full Screen Image");
        DBCursor cursor = coll.find(query);
        String result = "", resultcopy = "";
        int subsection_it_was_added = 0;
        int section_it_was_added = 0;
        while (cursor.hasNext()) {
            DBObject tobj = cursor.next();
            result = tobj.get("_id").toString();
            resultcopy = result;
            image_description_to_be_sent = tobj.get("definition").toString();
        }
        String[] temp1 = result.split(":");
        String resa = temp1[3];
        String[] resb = resa.split(",");
        String resc = resb[0];
        String courseid = resc.substring(2, resc.length() - 2);
        System.out.println(courseid);
        String[] temp2 = resultcopy.split(":");
        String rese = temp2[5];
        String[] resf = rese.split(",");
        String resg = resf[0];
        String problemid_edx = resg.substring(2, resg.length() - 2);
        System.out.println(problemid_edx);
        //System.out.println();
        String subsectioname = "";
        String subsection_name_to_be_sent = "";
        String line;
        Process p = Runtime.getRuntime().exec(new String[] {
            "/bin/bash", "-c", "php /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/contenthash.php"
        });
        BufferedReader input = new BufferedReader(new InputStreamReader(p.getInputStream()));
        String contenthash = "";
        while ((line = input.readLine()) != null) {
            contenthash = line;
        }
        input.close();
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
            System.out.println(path);
            String[] temp = path.split("/");
            int idtomatch = Integer.parseInt(temp[3]);
            sql = "select * from mdl_context where id=" + idtomatch;
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                idtomatch = rs.getInt("instanceid");
            }
            sql = "select * from mdl_course where idnumber=" + "'" + courseid + "'";
            rs = stmt.executeQuery(sql);
            int id = 0;
            while (rs.next()) {
                id = rs.getInt("id");
            }
            if (idtomatch == id) {
                flag = 0;
            }
        }
        if (flag == 1) {
            String subdirectory1 = contenthash.substring(0, 2);
            String subdirectory2 = contenthash.substring(2, 4);
            System.out.println(contenthash);
            System.out.println(subdirectory1);
            System.out.println(subdirectory2);
            /////////////////////////////////////////////////////////
            int image_no_in_the_course = 0;
            BasicDBObject query2 = new BasicDBObject("_id.category", "html").append("metadata.display_name", "Full Screen Image").append("_id.course", courseid);
            //System.out.println(query2);
            cursor = coll.find(query2);
            while (cursor.hasNext()) {
                DBObject tobj = cursor.next();
                image_no_in_the_course = image_no_in_the_course + 1;
                //System.out.println(image_no_in_the_course);
            }
            /////////////////////////////////////////////////////////
            // courseid and problemid fetched
            BasicDBObject query1 = new BasicDBObject("_id.category", "course");
            cursor = coll.find(query1);
            while (cursor.hasNext()) {
                DBObject tobj = cursor.next();
                result = tobj.get("definition").toString();
                resultcopy = result;
                String[] temp3 = result.split("]");
                String resd = temp3[0];
                String resi = resd.substring(17, resd.length());
                if (resi.compareTo("") != 0) {
                    String[] temp4 = result.split("/");
                    if (temp4[3].compareTo(courseid) == 0) {
                        String[] temp5 = resi.replace(" ", "").replace("\"", "").split(","); // ids of all section
                        String[] chapterids = new String[temp5.length];
                        for (int i = 0; i < temp5.length; i++) {
                            chapterids[i] = temp5[i].substring(temp5[i].length() - 32, temp5[i].length());
                            //System.out.println(chapterids[i]+": Section");
                            BasicDBObject query3 = new BasicDBObject("_id.category", "chapter");
                            cursor = coll.find(query3);
                            while (cursor.hasNext()) {
                                tobj = cursor.next();
                                result = tobj.get("_id").toString();
                                resultcopy = tobj.get("definition").toString();
                                //System.out.println(" "+result);
                                String[] temp1ch = result.split(":");
                                String resach = temp1ch[5];
                                String[] resbch = resach.split(",");
                                String rescch = resbch[0];
                                String courseidch = rescch.substring(2, rescch.length() - 2);
                                if (chapterids[i].compareTo(courseidch) == 0) // enter the section
                                {
                                    //System.out.println(resultcopy);
                                    String[] tempaach = resultcopy.split("]");
                                    //System.out.println(tempaach[0]);
                                    String resiich = tempaach[0].substring(17, tempaach[0].length());
                                    String resiiich = resiich.replace(" ", "").replace("\"", "");
                                    //System.out.println(resiiich);
                                    String[] temp7 = resiiich.split(",");
                                    String[] sequenceids = new String[temp7.length];
                                    for (int l = 0; l < temp7.length; l++) {
                                        sequenceids[l] = temp7[l].substring(temp7[l].length() - 32, temp7[l].length());
                                        //System.out.println("  "+sequenceids[l]+": SubSection"); // ids of all subsections
                                        BasicDBObject query4 = new BasicDBObject("_id.category", "sequential");
                                        cursor = coll.find(query4);
                                        while (cursor.hasNext()) {
                                            tobj = cursor.next();
                                            result = tobj.get("_id").toString();
                                            resultcopy = tobj.get("definition").toString();
                                            //System.out.println(" "+result);
                                            subsectioname = tobj.get("metadata").toString();
                                            String[] temp1sq = result.split(":");
                                            String resasq = temp1sq[5];
                                            String[] resbsq = resasq.split(",");
                                            String rescsq = resbsq[0];
                                            String courseidsq = rescsq.substring(2, rescsq.length() - 2);
                                            //System.out.println(courseidsq);
                                            if (sequenceids[l].compareTo(courseidsq) == 0) {
                                                //System.out.println(resultcopy);
                                                String[] tempaasq = resultcopy.split("]");
                                                //System.out.println(tempaach[0]);
                                                String resiisq = tempaasq[0].substring(17, tempaasq[0].length());
                                                String resiiisq = resiisq.replace(" ", "").replace("\"", "");
                                                //System.out.println(resiiisq);
                                                String[] temp8 = resiiisq.split(",");
                                                String[] verticalids = new String[temp8.length];
                                                for (int m = 0; m < temp8.length; m++) {
                                                    verticalids[m] = temp8[m].substring(temp8[m].length() - 32, temp8[m].length());
                                                    //System.out.println("      "+verticalids[m]+": Unit"); // ids of all units
                                                    BasicDBObject query5 = new BasicDBObject("_id.category", "vertical");
                                                    cursor = coll.find(query5);
                                                    while (cursor.hasNext()) {
                                                        tobj = cursor.next();
                                                        result = tobj.get("_id").toString();
                                                        resultcopy = tobj.get("definition").toString();
                                                        //System.out.println(" "+result);
                                                        String[] temp1vr = result.split(":");
                                                        String resavr = temp1vr[5];
                                                        String[] resbvr = resavr.split(",");
                                                        String rescvr = resbvr[0];
                                                        String courseidvr = rescvr.substring(2, rescvr.length() - 2);
                                                        //System.out.println(courseidvr);
                                                        if (verticalids[m].compareTo(courseidvr) == 0) {
                                                            //System.out.println(resultcopy);
                                                            String[] tempaavr = resultcopy.split("]");
                                                            //System.out.println(tempaach[0]);
                                                            String resiivr = tempaavr[0].substring(17, tempaavr[0].length());
                                                            String resiiivr = resiivr.replace(" ", "").replace("\"", "");
                                                            //System.out.println(resiiivr);
                                                            String[] temp9 = resiiivr.split(",");
                                                            String[] problemids = new String[temp9.length];
                                                            for (int n = 0; n < temp9.length; n++) {
                                                                problemids[n] = temp9[n].substring(temp9[n].length() - 32, temp9[n].length());
                                                                //System.out.println("          "+problemids[n]+": Problem/Video/Image"); // ids of all problems
                                                                if (problemids[n].compareTo(problemid_edx) == 0) {
                                                                    //System.out.println("\nProblem is in Section "+(i+1));
                                                                    //System.out.println("\nProblem is in Section "+(i+1));
                                                                    section_it_was_added = i + 1;
                                                                    subsection_it_was_added = l + 1;
                                                                    subsection_name_to_be_sent = subsectioname;
                                                                    //System.out.println("image:\n"+image_description_to_be_sent);
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            subsection_name_to_be_sent = subsection_name_to_be_sent.substring(20, subsection_name_to_be_sent.length() - 2);
            System.out.print("Image is in Section: " + section_it_was_added + ", Image is in SubSection: " + subsection_it_was_added);
            System.out.println(", Subsection Name: " + subsection_name_to_be_sent);
            image_description_to_be_sent = image_description_to_be_sent.substring(image_description_to_be_sent.indexOf("<h2>"), image_description_to_be_sent.indexOf("</p>\\n<p><img"));
            image_description_to_be_sent = image_description_to_be_sent.replace("<h2>", "");
            image_description_to_be_sent = image_description_to_be_sent.replace("</h2>", "");
            image_description_to_be_sent = image_description_to_be_sent.replace("Full Screen Image", "");
            image_description_to_be_sent = image_description_to_be_sent.replace("<p>", "");
            image_description_to_be_sent = image_description_to_be_sent.replace("\\n", "");
            System.out.println(image_description_to_be_sent);
            System.out.println("Image no. in the course: " + image_no_in_the_course);
            System.out.println("Image name: " + subsection_name_to_be_sent.concat("__Image__").concat(Integer.toString(image_no_in_the_course)));
            p = Runtime.getRuntime().exec(new String[] {
                "/bin/bash", "-c", "file --mime-type -b /home/rajarshi/edx_to_moodle_synchronisation/image_transfer/image"
            });
            input = new BufferedReader(new InputStreamReader(p.getInputStream()));
            String mimetype = "";
            while ((line = input.readLine()) != null) {
                mimetype = line;
            }
            System.out.println(mimetype);
            String filepathforsize = "/var/moodledata/filedir/" + subdirectory1 + "/" + subdirectory2 + "/" + contenthash;
            System.out.println(filepathforsize);
            long filesize = getFileSize(filepathforsize);
            System.out.println(filesize);
            //for mdl_file part 1..................................
            int contextId = 5;
            String component = "user";
            String filearea = "draft";
            String[] temp = mimetype.split("/");
            String filename = subsection_name_to_be_sent.concat("__Image__").concat(Integer.toString(image_no_in_the_course)) + "." + temp[1];
            System.out.println(filename);
            String filepath = "/";
            int itemid = (int)(Math.random() * 1000000000);
            String inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + filename;
            String pathnamehash = sha1(inputforpathhash);
            String sourcename = "O:8:\"stdClass\":1:{s:6:\"source\";s:38:\"" + filename + "\";}";
            //System.out.println(sourcename);
            sql = "Insert into mdl_files (contenthash,pathnamehash,contextid,component,filearea,itemid,filepath,filename,userid,filesize,mimetype,status,source,author,license,timecreated,timemodified,sortorder)" + "values ('" + contenthash + "','" + pathnamehash + "','" + contextId + "','" + component + "','" + filearea + "','" + itemid + "','" + filepath + "','" + filename + "',2,'" + filesize + "','" + mimetype + "',0,'" + sourcename + "','Rajarshi Sarkar','allrightsreserved',0,0,0)";
            stmt.execute(sql);
            inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + ".";
            pathnamehash = sha1(inputforpathhash);
            sql = "Insert into mdl_files (contenthash,pathnamehash,contextid,component,filearea,itemid,filepath,filename,userid,filesize,status,timecreated,timemodified,sortorder)" + "values ('da39a3ee5e6b4b0d3255bfef95601890afd80709','" + pathnamehash + "','" + contextId + "','" + component + "','" + filearea + "','" + itemid + "','" + filepath + "','.',2,0,0,0,0,0)";
            stmt.execute(sql);
            //end of mdl_file part1.....................................................................
            //for mdl_context.................................
            String test = "select * from mdl_course";
            rs = stmt.executeQuery(test);
            int courseid1 = 0;
            String coursenumber = "";
            while (rs.next()) {
                courseid1 = rs.getInt("id");
                coursenumber = rs.getString("idnumber");
                if (coursenumber.compareTo(courseid) == 0) break;
            }
            String test1 = "select * from mdl_context where instanceid=" + courseid1 + " and contextlevel=50";
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
            //System.out.println(instanceidcontent);
            String path_for_mdl_context = "/1/3/" + Integer.toString(idagainstinstanceid) + "/";
            test1 = "insert into mdl_context (contextlevel, instanceid, path, depth)" + " values(70,'" + instanceidcontent + "','" + path_for_mdl_context + "',4)";
            //System.out.println(test1);
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
            //System.out.println(test1);
            stmt.execute(test1);
            //end of mdl_context.....................
            //for mdl_file part 2...........................
            contextId = idforpath;
            System.out.println(contextId);
            component = "mod_resource";
            filearea = "content";
            itemid = 0;
            inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + filename;
            System.out.println(inputforpathhash);
            pathnamehash = sha1(inputforpathhash);
            sql = "Insert into mdl_files (contenthash,pathnamehash,contextid,component,filearea,itemid,filepath,filename,userid,filesize,mimetype,status,source,author,license,timecreated,timemodified,sortorder)" + "values ('" + contenthash + "','" + pathnamehash + "','" + contextId + "','" + component + "','" + filearea + "','" + itemid + "','" + filepath + "','" + filename + "',2,'" + filesize + "','" + mimetype + "',0,'" + filename + "','Rajarshi Sarkar','allrightsreserved',0,0,1)";
            stmt.execute(sql);
            inputforpathhash = "/" + contextId + "/" + component + "/" + filearea + "/" + itemid + "/" + ".";
            //System.out.println(inputforpathhash);
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
            String intro = "";
            if (image_description_to_be_sent.compareTo("") == 0) {
                intro = "<p>No Description Available</p>";
            } else {
                intro = "<p>" + image_description_to_be_sent + "</p>";
            }
            sql = "insert into mdl_resource (course,name,intro,introformat,tobemigrated,legacyfiles,display,displayoptions,filterfiles,revision,timemodified)" + "values ('" + courseid1 + "','" + filename.substring(0, filename.length() - 4) + "','" + intro + "',1,0,0,0,'" + displayoptions + "',0,1,0)";
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
            System.out.println(idforsequence);
            int section = 0;
            String sequence = "";
            sql = "select * from mdl_course_sections where course=" + courseid1 + " and section=" + section_it_was_added;
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                section = rs.getInt("id");
                sequence = rs.getString("sequence");
            }
            System.out.println(section);
            String temptocompare = "";
            if (sequence.compareTo(temptocompare) == 0) {
                sequence = Integer.toString(idforsequence);
            } else {
                sequence = sequence + "," + Integer.toString(idforsequence);
            }
            System.out.println(sequence);
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
            sql = "insert into mdl_course_modules(course,module,instance,section,added,score,indent,visible,visibleold,groupmode,groupingid,groupmembersonly,completion,completionview,completionexpected,availablefrom,availableuntil,showavailability,showdescription)" + " values('" + courseid1 + "',17,'" + instanceid + "','" + section + "',0,0,0,1,1,0,0,0,0,0,0,0,0,0,0)";
            System.out.println(sql);
            stmt.execute(sql);
            //end of mdl_course_modules.............................................................
            //System.out.println(filename);
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
    public static void getMimeType(String input) {
        File f = new File(input);
        System.out.println("Mime Type of " + f.getName() + " is " + new MimetypesFileTypeMap().getContentType(f));
    }
}