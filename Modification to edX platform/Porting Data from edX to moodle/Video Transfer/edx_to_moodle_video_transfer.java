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

public class edx_to_moodle_video_transfer {
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
        DB db = mongoClient.getDB("xmodule");
        DBCollection coll = db.getCollection("modulestore");
        String video_to_be_sent = "";
        BasicDBObject query = new BasicDBObject("_id.category", "video");
        DBCursor cursor = coll.find(query);
        String result = "", resultcopy = "";
        int subsection_it_was_added = 0;
        int section_it_was_added = 0;
        while (cursor.hasNext()) {
            DBObject tobj = cursor.next();
            result = tobj.get("_id").toString();
            resultcopy = result;
            video_to_be_sent = tobj.get("metadata").toString();
        }
        String[] temp1 = result.split(":");
        String resa = temp1[3];
        String[] resb = resa.split(",");
        String resc = resb[0];
        String courseid = resc.substring(2, resc.length() - 2);
        System.out.println(courseid);
        video_to_be_sent = video_to_be_sent.replace("{", "");
        String temp10[] = video_to_be_sent.split(",");
        String temp11[] = temp10[0].split(":");
        temp11[1] = temp11[1].replace("\"", "");
        video_to_be_sent = "https://www.youtube.com/watch?v=" + temp11[1].substring(1, temp11[1].length());
        String temp12[] = temp10[1].split(",");
        String temp13[] = temp12[0].split(":");
        temp13[1] = temp13[1].replace("\"", "");
        String video_name_to_be_sent = temp13[1];
        video_to_be_sent = video_to_be_sent.substring(0, video_to_be_sent.length() - 1);
        System.out.println(video_to_be_sent);
        video_name_to_be_sent = video_name_to_be_sent.substring(1, video_name_to_be_sent.length() - 1);
        System.out.println(video_name_to_be_sent);
        String sql = "select * from mdl_course where idnumber=" + "'" + courseid + "'";
        System.out.println(sql);
        ResultSet rs = stmt.executeQuery(sql);
        int id = 0;
        while (rs.next()) {
            id = rs.getInt("id");
        }
        System.out.println(id);
        sql = "select * from mdl_url where course=" + id + " and externalurl=" + "'" + video_to_be_sent + "'";
        rs = stmt.executeQuery(sql);
        int flag = 1;
        while (rs.next()) {
            flag = 0;
        }
        if (flag == 1) {
            String[] temp2 = resultcopy.split(":");
            String rese = temp2[5];
            String[] resf = rese.split(",");
            String resg = resf[0];
            String problemid_edx = resg.substring(2, resg.length() - 2);
            System.out.println(problemid_edx);
            //System.out.println();
            String subsectioname = "";
            String subsection_name_to_be_sent = "";
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
                                                                //System.out.println("          "+problemids[n]+": Problem or Video"); // ids of all problems
                                                                if (problemids[n].compareTo(problemid_edx) == 0) {
                                                                    //System.out.println("\nProblem is in Section "+(i+1));
                                                                    //System.out.println("\nProblem is in Section "+(i+1));
                                                                    section_it_was_added = i + 1;
                                                                    subsection_it_was_added = l + 1;
                                                                    subsection_name_to_be_sent = subsectioname;
                                                                    //System.out.println("Question:\n"+video_to_be_sent);
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
            System.out.print("Problem/Video is in Section: " + section_it_was_added + ", Problem/Video is in SubSection: " + subsection_it_was_added);
            System.out.print(", Subsection Name: " + subsection_name_to_be_sent);
            System.out.println();
            //video_to_be_sent = video_to_be_sent.replace(" ", "");
            cursor.close();
            //for mdl_context.................................
            String test1 = "select * from mdl_context where instanceid=" + id + " and contextlevel=50";
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
            //System.out.println(test1);
            stmt.execute(test1);
            rs = stmt.executeQuery("select * from mdl_context where id =(select max(id) from mdl_context)");
            int idforpath = 0;
            while (rs.next()) {
                idforpath = rs.getInt("id");
            }
            path_for_mdl_context = "'/1/3/" + Integer.toString(idagainstinstanceid) + "/" + Integer.toString(idforpath) + "'";
            //System.out.println(path_for_mdl_context);
            rs = stmt.executeQuery("select * from mdl_context");
            int lastidfromcontexttable = 0;
            while (rs.next()) {
                lastidfromcontexttable = rs.getInt("id");
            }
            test1 = "update mdl_context set path =" + path_for_mdl_context + " where id =" + Integer.toString(lastidfromcontexttable);
            //System.out.println(test1);
            stmt.execute(test1);
            //end of mdl_context.....................
            //for mdl_course_sections 
            int idforsequence = 0;
            sql = "select * from mdl_context where contextlevel=70 and id=(select max(id) from mdl_context)";
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                idforsequence = rs.getInt("instanceid");
            }
            int section = 0;
            String sequence = "";
            sql = "select * from mdl_course_sections where course=" + id + " and section=" + section_it_was_added;
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                section = rs.getInt("id");
                sequence = rs.getString("sequence");
            }
            //System.out.println(section);
            String temptocompare = "";
            if (sequence.compareTo(temptocompare) == 0) {
                sequence = Integer.toString(idforsequence);
            } else {
                sequence = sequence + "," + Integer.toString(idforsequence);
            }
            sql = "update mdl_course_sections set sequence=" + "'" + sequence + "'" + " where id=" + section;
            System.out.println(sql);
            stmt.execute(sql);
            //end of mdl_course_sections................................................
            //start of mdl_course_modules...............................................
            int instanceid = 0;
            sql = "select * from mdl_course_modules where module=20";
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                instanceid = rs.getInt("instance");
            }
            instanceid++;
            System.out.println(instanceid);
            sql = "insert into mdl_course_modules(course,module,instance,section,added,score,indent,visible,visibleold,groupmode,groupingid,groupmembersonly,completion,completionview,completionexpected,availablefrom,availableuntil,showavailability,showdescription)" + " values('" + id + "',20,'" + instanceid + "','" + section + "',0,0,0,1,1,0,0,0,0,0,0,0,0,0,0)";
            //System.out.println(sql);
            stmt.execute(sql);
            //end of mdl_course_modules.............................................................
            //for mdl_url to fill
            String displayoption = "a:2:{s:12:" + "\"printheading\";i:0;s:10:" + "\"printintro\";i:1;}";
            //System.out.println(displayoption);
            sql = "insert into mdl_url (course,name,intro,introformat,externalurl,display,displayoptions,parameters,timemodified)" + " values('" + id + "','" + video_name_to_be_sent + "','<p>No Description Available</p>',1,'" + video_to_be_sent + "',1,'" + displayoption + "','a:0:{}',0)";
            System.out.println(sql);
            stmt.execute(sql);
        }
    }
}