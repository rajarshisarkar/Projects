import com.mongodb.MongoClient;
import com.mongodb.DB;
import com.mongodb.DBCollection;
import com.mongodb.BasicDBObject;
import com.mongodb.DBObject;
import com.mongodb.DBCursor;
import java.net.UnknownHostException;
import java.sql.*;

public class edx_to_moodle_course_synchronisation
{
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
    static final String DB_URL = "jdbc:mysql://localhost/moodle";
    static final String USER = "root";
    static final String PASS = "root";
   
    public static void main(String[] args) throws ClassNotFoundException, UnknownHostException
    {
        // load the sqlite-JDBC driver using the current class loader
        Class.forName("org.sqlite.JDBC");
        Class.forName("com.mysql.jdbc.Driver");
        String resd="", sql="";
        Connection conn = null; //mysql connection
        Connection connection = null; //sqlite connection
       
        try
        {
            conn = DriverManager.getConnection(DB_URL,USER,PASS);
            // create a database connection
            connection = DriverManager.getConnection("jdbc:sqlite:/home/rajarshi/edx_all/db/edx.db");
           
            Statement stmt = conn.createStatement(); //mysql statement
            Statement statement = connection.createStatement();
            statement.setQueryTimeout(30); // set timeout to 30 sec.
           
            //read from edx
            ResultSet rs = statement.executeQuery("select course_id from student_courseaccessrole where id = (select max(id) from student_courseaccessrole)");
            String course_id=rs.getString("course_id");
            String[] temp;
            String delimiter="/";
            temp=course_id.split(delimiter);
            //System.out.println(temp[0]+ " " + temp[1] + " " +temp[2]);
           
            //To connect to mongodb server
            MongoClient mongoClient = new MongoClient( "localhost" , 27017 );
            //Now connect to your databases
            DB db = mongoClient.getDB( "xmodule" );
            //System.out.println("Connection to Database Successfull");
            DBCollection coll = db.getCollection("modulestore");
            //System.out.println("Collection Selected Successfull");
           
            BasicDBObject query = new BasicDBObject("_id.category", "course").append("_id.course", temp[1]);
            //BasicDBObject query = new BasicDBObject("_id.category", "course").append("_id.course", "CS201");
            DBCursor cursor = coll.find(query);
            String result="";
            while(cursor.hasNext())
            {
                DBObject tobj = cursor.next();
                result = tobj.get("metadata").toString();
            }
            String[] temp1 = result.split(":");
            String resa = temp1[14];
            String[] resb = resa.split(",");
            //System.out.print(resb[0]);
            String resc = resb[0];
            resd = resc.substring(2, resc.length()-2);
            //System.out.print("Course Name: " +resd);
            cursor.close();
           
            String coursename = resd;
            String shortname=generateInitials(coursename);
            String idtomatch="";
            //read from moodle
            rs = stmt.executeQuery("select idnumber from mdl_course where id = (select max(id) from mdl_course)");
            while(rs.next())
            {
                 idtomatch= (String) rs.getString("idnumber").toString();
            }
           
            if(temp[1].compareTo(idtomatch)!=0)
            {
                //write into moodle(mdl_course)
                sql = "insert into mdl_course (category,fullname,shortname,sortorder,idnumber,summary,summaryformat,showgrades,newsitems,startdate,marker,maxbytes,legacyfiles,showreports,visible,visibleold,groupmode,groupmodeforce,defaultgroupingid,timecreated,timemodified,requested,enablecompletion,completionnotify)" + "values (1,'"+coursename+"','"+shortname+"',10000,'"+temp[1]+"','Course Summary has not been entered',1,1,5,1609353000,0,0,0,0,1,1,0,0,0,0,0,0,0,0)";
                // startdate (31/12/2020)= 1609353000
                stmt.executeUpdate(sql);
                stmt.executeUpdate("update mdl_course set sortorder=sortorder+1");
                stmt.executeUpdate("update mdl_course set sortorder=1 where id=1;");
            }
        }
        catch(SQLException e)
        {
             // if the error message is "out of memory", it probably means no database file is found
             System.err.println(e.getMessage());
        }
        finally
        {
            try
            {
                if(connection != null)
                connection.close();
            }
            catch(SQLException e)
            {
                // connection close failed.
                System.err.println(e);
            }
        }
    }
   
    public static String generateInitials(String original)
    {
        String initial = "";
        String[] split = original.split(" ");
        for(String value : split)
        {
            initial += value.substring(0,1);
        }
        return initial.toUpperCase();
    }
}
