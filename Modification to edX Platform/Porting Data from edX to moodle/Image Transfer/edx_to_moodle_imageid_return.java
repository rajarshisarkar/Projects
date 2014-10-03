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

public class edx_to_moodle_imageid_return {
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
        //System.out.println(courseid);
        String[] temp2 = resultcopy.split(":");
        String rese = temp2[5];
        String[] resf = rese.split(",");
        String resg = resf[0];
        String problemid_edx = resg.substring(2, resg.length() - 2);
        System.out.println(problemid_edx);
        System.out.println();
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
    }
}