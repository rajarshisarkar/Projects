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

public class edx_to_moodle_quiz_question_transfer {
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
        String question_to_be_sent = "";
        BasicDBObject query = new BasicDBObject("_id.category", "problem");
        DBCursor cursor = coll.find(query);
        String result = "", resultcopy = "";
        int subsection_it_was_added = 0;
        int section_it_was_added = 0;
        while (cursor.hasNext()) {
            DBObject tobj = cursor.next();
            result = tobj.get("_id").toString();
            resultcopy = result;
            question_to_be_sent = tobj.get("metadata").toString();
        }
        String[] temp1 = result.split(":");
        String resa = temp1[3];
        String[] resb = resa.split(",");
        String resc = resb[0];
        String courseid = resc.substring(2, resc.length() - 2);
        System.out.println(courseid);
        question_to_be_sent = question_to_be_sent.replace("\\n", "");
        question_to_be_sent = question_to_be_sent.replace(">>", " ");
        question_to_be_sent = question_to_be_sent.replace("<<", "");
        question_to_be_sent = question_to_be_sent.replace("{ \"markdown\" : \"", "");
        question_to_be_sent = question_to_be_sent.replace("     ", "");
        question_to_be_sent = question_to_be_sent.replace("[explanation]", "|");
        int zj = question_to_be_sent.lastIndexOf(",");
        String[] temp10 = {
            question_to_be_sent.substring(0, zj), question_to_be_sent.substring(zj)
        };
        question_to_be_sent = temp10[0].substring(0, temp10[0].length() - 3);
        String[] temp12 = question_to_be_sent.split("\\|");
        String explanation = temp12[1];
        question_to_be_sent = temp12[0];
        int correctoption = 0;
        String[] temp11 = question_to_be_sent.split("\\(");
        String question = temp11[0]; // this is the question
        System.out.println(question);
        //System.out.println(explanation); // this is the question explanation
        //System.out.println("Correct Option: "+correctoption); // this is the correct option
        if (question.compareTo("A multiple choice problem presents radio buttons for student input. Students can only select a single option presented. Multiple Choice questions have been the subject of many areas of research due to the early invention and adoption of bubble sheets.One of the main elements that goes into a good multiple choice question is the existence of good distractors. That is, each of the alternate responses presented to the student should be the result of a plausible mistake that a student might make. What Apple device competed with the portable CD player?") != 0) {
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
                                                                //System.out.println("          "+problemids[n]+": Problem"); // ids of all problems
                                                                if (problemids[n].compareTo(problemid_edx) == 0) {
                                                                    //System.out.println("\nProblem is in Section "+(i+1));
                                                                    //System.out.println("\nProblem is in Section "+(i+1));
                                                                    section_it_was_added = i + 1;
                                                                    subsection_it_was_added = l + 1;
                                                                    subsection_name_to_be_sent = subsectioname;
                                                                    //System.out.println("Question:\n"+question_to_be_sent);
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
            //System.out.print("Problem is in Section: "+section_it_was_added+", Problem is in SubSection: "+subsection_it_was_added);
            //System.out.println(", Subsection Name: " +subsection_name_to_be_sent);
            for (int zz = 1; zz < temp11.length; zz++) {
                String check_first = temp11[zz].substring(0, 1);
                if (check_first.compareTo("x") == 0) correctoption = zz;
                temp11[zz] = temp11[zz].substring(3, temp11[zz].length());
                //System.out.println(temp11[zz]); 
            }
            cursor.close();
            subsection_name_to_be_sent = subsection_name_to_be_sent.concat(" Quiz");
            String sql = "select * from mdl_course where idnumber=" + "'" + courseid + "'";
            System.out.println(sql);
            ResultSet rs = stmt.executeQuery(sql);
            int id = 0;
            while (rs.next()) {
                id = rs.getInt("id");
            }
            System.out.println(id);
            String quizname = "";
            quizname = subsection_name_to_be_sent;
            //System.out.println(quizname);
            sql = "insert into mdl_quiz (course,name,intro,introformat,timeopen,timeclose,timelimit,overduehandling,graceperiod,preferredbehaviour,attempts,attemptonlast,grademethod,decimalpoints,questiondecimalpoints,reviewattempt,reviewcorrectness,reviewmarks,reviewspecificfeedback,reviewgeneralfeedback,reviewrightanswer,reviewoverallfeedback,questionsperpage,navmethod,shufflequestions,shuffleanswers,questions,sumgrades,grade,timecreated,timemodified,password,subnet,browsersecurity,delay1,delay2,showuserpicture,showblocks)" +
                "values('" + id + "','" + quizname + "','',1,0,0,0,'autoabandon',0,'deferredfeedback',0,0,1,2,-1,69904,4368,4368,4368,4368,4368,4368,1,'free',0,1,'',0.00000,10.00000,0,0,'','','-',0,0,0,0)";
            //stmt.execute(sql);
            sql = "select * from mdl_course_modules where module=16";
            rs = stmt.executeQuery(sql);
            int tempinstance = 0;
            while (rs.next()) {
                tempinstance = rs.getInt("instance");
            }
            tempinstance++;
            sql = "select * from mdl_course_sections where course=" + id + " and section=" + section_it_was_added;
            rs = stmt.executeQuery(sql);
            int section = 0;
            while (rs.next()) {
                section = rs.getInt("id");
            }
            sql = "select * from mdl_course_modules where id=(select max(id) from mdl_course_modules)";
            rs = stmt.executeQuery(sql);
            int sequenceNo = 0;
            while (rs.next()) {
                sequenceNo = rs.getInt("id");
            }
            //System.out.println(sequenceNo);
            String sequence = "";
            sql = "select * from mdl_course_sections where course=" + id + " and section=" + section_it_was_added;
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                sequence = rs.getString("sequence");
            }
            String temptocompare = "";
            //to add a quiz if it is not already added......................
            sql = "select * from mdl_quiz where course=" + id + " and name=" + "'" + quizname + "'";
            rs = stmt.executeQuery(sql);
            int flag = 0;
            while (rs.next()) {
                flag = rs.getInt("id");
            }
            if (flag == 0) {
                sql = "insert into mdl_quiz (course,name,intro,introformat,timeopen,timeclose,timelimit,overduehandling,graceperiod,preferredbehaviour,attempts,attemptonlast,grademethod,decimalpoints,questiondecimalpoints,reviewattempt,reviewcorrectness,reviewmarks,reviewspecificfeedback,reviewgeneralfeedback,reviewrightanswer,reviewoverallfeedback,questionsperpage,navmethod,shufflequestions,shuffleanswers,questions,sumgrades,grade,timecreated,timemodified,password,subnet,browsersecurity,delay1,delay2,showuserpicture,showblocks)" +
                    "values('" + id + "','" + quizname + "','',1,0,0,0,'autoabandon',0,'deferredfeedback',0,0,1,2,-1,69904,4368,4368,4368,4368,4368,4368,1,'free',0,1,'',0.00000,10.00000,0,0,'','','-',0,0,0,0)";
                stmt.execute(sql);
                sql = "select * from mdl_course_modules where module=16";
                rs = stmt.executeQuery(sql);
                tempinstance = 0;
                while (rs.next()) {
                    tempinstance = rs.getInt("instance");
                }
                tempinstance++;
                sql = "select * from mdl_course_sections where course=" + id + " and section=" + section_it_was_added;
                rs = stmt.executeQuery(sql);
                section = 0;
                while (rs.next()) {
                    section = rs.getInt("id");
                }
                sql = "insert into mdl_course_modules (course,module,instance,section,added,score,indent,visible,visibleold,groupmode,groupingid,groupmembersonly,completion,completionview,completionexpected,availablefrom,availableuntil,showavailability,showdescription)" + " values('" + id + "',16,'" + tempinstance + "','" + section + "',0,0,0,1,1,0,0,0,0,0,0,0,0,0,0)";
                stmt.execute(sql);
                sql = "select * from mdl_course_modules where id=(select max(id) from mdl_course_modules)";
                rs = stmt.executeQuery(sql);
                sequenceNo = 0;
                while (rs.next()) {
                    sequenceNo = rs.getInt("id");
                }
                //System.out.println(sequenceNo);
                sequence = "";
                sql = "select * from mdl_course_sections where course=" + id + " and section=" + section_it_was_added;
                rs = stmt.executeQuery(sql);
                while (rs.next()) {
                    //section=rs.getInt("id");
                    sequence = rs.getString("sequence");
                }
                temptocompare = "";
                if (sequence.compareTo(temptocompare) == 0) {
                    sequence = Integer.toString(sequenceNo);
                } else {
                    sequence = sequence + "," + Integer.toString(sequenceNo);
                }
                sql = "update mdl_course_sections set sequence=" + "'" + sequence + "'" + " where id=" + section;
                System.out.println(sql);
                stmt.execute(sql);
            }
            //end of mdl quiz
            //.........................................
            int flagforquestion = 1;
            sql = "select * from mdl_course where id=" + id;
            rs = stmt.executeQuery(sql);
            String shortnametocomp = "";
            while (rs.next()) {
                shortnametocomp = rs.getString("shortname");
            }
            System.out.println(shortnametocomp);
            String questiontext = "<p>" + question + "</p>";
            sql = "select * from mdl_question where questiontext=" + "'" + questiontext + "'";
            rs = stmt.executeQuery(sql);
            int temp_category = 0;
            int questionid = 0;
            while (rs.next()) {
                temp_category = rs.getInt("category");
                //System.out.println(temp_category+"hii");
                //quesno=rs.getInt("id");
                String tempshortname = "";
                sql = "select * from mdl_question_categories where id=" + temp_category;
                ResultSet temprs = stmt1.executeQuery(sql);
                while (temprs.next()) {
                    tempshortname = temprs.getString("name");
                    tempshortname = tempshortname.substring(12, tempshortname.length());
                    //System.out.println(temp_category+" "+tempshortname);
                    if (tempshortname.compareTo(shortnametocomp) == 0) {
                        questionid = rs.getInt("id");
                        //System.out.println(temp_category+" "+tempshortname+" "+questionid);
                        sql = "select * from mdl_question_answers where question=" + questionid;
                        ResultSet rs1 = stmt2.executeQuery(sql);
                        int count = 0;
                        while (rs1.next()) {
                            count++;
                        }
                        // System.out.println(count+"oo"+temp11.length);
                        int i = 1;
                        String tempanswer = "";
                        if (count == ((temp11.length) - 1)) {
                            //System.out.println(count+"oo"+temp11.length);
                            sql = "select * from mdl_question_answers where question=" + questionid;
                            rs1 = stmt2.executeQuery(sql);
                            while (rs1.next()) {
                                tempanswer = rs1.getString("answer");
                                if (tempanswer.compareTo("<p>" + temp11[i] + "</p>") == 0) {
                                    flagforquestion = 0;
                                } else {
                                    flagforquestion = 1;
                                    break;
                                }
                                i++;
                            }
                        }
                    }
                }
            }
            //to add a question when it is not added earlier in the given course
            if (flagforquestion == 1) {
                //to find is from mdl_context......................................
                sql = "select * from mdl_context where contextlevel=50 and instanceid=" + id;
                rs = stmt.executeQuery(sql);
                int contextid = 0;
                while (rs.next()) {
                    contextid = rs.getInt("id");
                }
                sql = "select * from mdl_question_categories where contextid=" + contextid;
                rs = stmt.executeQuery(sql);
                int category = 0;
                while (rs.next()) {
                    category = rs.getInt("id");
                }
                System.out.println(category);
                if (category == 0) {
                    String shortname = "";
                    sql = "select * from mdl_course where id=" + id;
                    rs = stmt.executeQuery(sql);
                    while (rs.next()) {
                        shortname = rs.getString("shortname");
                    }
                    String name = "Default for " + shortname;
                    String info = "The default category for questions shared in context " + shortname;
                    SecureRandom random = new SecureRandom();
                    String stamp = new BigInteger(130, random).toString(32);
                    sql = "insert into mdl_question_categories (name,contextid,info,infoformat,stamp,parent,sortorder)" +
                        " values('" + name + "','" + contextid + "','" + info + "',0,'" + stamp + "',0,999)";
                    System.out.println(sql);
                    stmt.execute(sql);
                    sql = "select * from mdl_question_categories";
                    rs = stmt.executeQuery(sql);
                    while (rs.next()) {
                        category = rs.getInt("id");
                    }
                }
                questiontext = "<p>" + question + "</p>";
                SecureRandom random = new SecureRandom();
                String stamp = new BigInteger(130, random).toString(32);
                String version = new BigInteger(130, random).toString(32);
                sql = "insert into mdl_question (category,parent,name,questiontext,questiontextformat,generalfeedback,generalfeedbackformat,defaultmark,penalty,qtype,length,stamp,version,hidden,timecreated,timemodified,createdby,modifiedby)" + " values('" + category + "',0,'Question','" + questiontext + "',1,'',1,1.0000000,0.3333333,'multichoice',1,'" + stamp + "','" + version + "',0,0,0,2,2)";
                stmt.execute(sql);
                int quiz = 0;
                sql = "select * from mdl_quiz where course=" + id + " and name='" + subsection_name_to_be_sent + "'";
                rs = stmt.executeQuery(sql);
                while (rs.next()) {
                    quiz = rs.getInt("id");
                }
                sql = "select * from mdl_question";
                rs = stmt.executeQuery(sql);
                int questions = 0;
                while (rs.next()) {
                    questions = rs.getInt("id");
                }
                sql = "insert into mdl_quiz_question_instances(quiz,question,grade)" + " values('" + quiz + "','" + questions + "',1.0000000)";
                stmt.execute(sql);
                String fraction = "0.0000000";
                for (int zz = 1; zz < temp11.length; zz++) {
                    if (zz == correctoption) {
                        fraction = "1.0000000";
                    } else {
                        fraction = "0.0000000";
                    }
                    String answer = "<p>" + temp11[zz] + "</p>";
                    sql = "insert into mdl_question_answers(question,answer,answerformat,fraction,feedback,feedbackformat)" + " values('" + questions + "','" + answer + "',1,'" + fraction + "','',1)";
                    stmt.execute(sql);
                }
                sql = "select * from mdl_question_answers where question=" + questions;
                rs = stmt.executeQuery(sql);
                String answers = "";
                while (rs.next()) {
                    int idtemp = rs.getInt("id");
                    if (answers.compareTo("") == 0) {
                        answers = answers.concat(Integer.toString(idtemp));
                        continue;
                    }
                    answers = answers.concat(",").concat(Integer.toString(idtemp));
                    System.out.println(answers);
                }
                String correctfeedback = "";
                correctfeedback = "<p>" + explanation + "</p>";
                sql = "insert into mdl_question_multichoice (question,layout,answers,single,shuffleanswers,correctfeedback,correctfeedbackformat,partiallycorrectfeedback,partiallycorrectfeedbackformat,incorrectfeedback,incorrectfeedbackformat,answernumbering,shownumcorrect)" + " values('" + questions + "',0,'" + answers + "',1,1,'" + correctfeedback + "',1,'<p>Your answer is partially correct.</p>',1,'<p>Your answer is incorrect.</p>',1,'abc',1)";
                stmt.execute(sql);
                sql = "select * from mdl_question where questiontext=" + "'" + questiontext + "'";
                rs = stmt.executeQuery(sql);
                int idforquestion = 0;
                while (rs.next()) {
                    idforquestion = rs.getInt("id");
                }
                System.out.println(idforquestion);
                sql = "select * from mdl_quiz where name=" + "'" + subsection_name_to_be_sent + "'";
                rs = stmt.executeQuery(sql);
                String quizquestions = "";
                float sumgrade = 0;
                while (rs.next()) {
                    quizquestions = rs.getString("questions");
                    sumgrade = rs.getFloat("sumgrades");
                }
                if (quizquestions.compareTo("") == 0) {
                    quizquestions = quizquestions.concat(Integer.toString(idforquestion)) + "," + "0";
                } else {
                    quizquestions = quizquestions.substring(0, quizquestions.length() - 1).concat(Integer.toString(idforquestion)) + "," + "0";
                }
                sql = "update mdl_quiz set questions=" + "'" + quizquestions + "'" + " where name=" + "'" + subsection_name_to_be_sent + "'";
                stmt.execute(sql);
                sumgrade++;
                String sumgradestring = Float.toString(sumgrade) + "0000";
                sql = "update mdl_quiz set sumgrades=" + "'" + sumgradestring + "'" + " where name=" + "'" + subsection_name_to_be_sent + "'";
                stmt.execute(sql);
            }
        }
    }
}