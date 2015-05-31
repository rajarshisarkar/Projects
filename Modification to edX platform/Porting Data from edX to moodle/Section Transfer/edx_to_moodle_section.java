import com.mongodb.MongoClient;
import com.mongodb.DB;
import com.mongodb.DBCollection;
import com.mongodb.BasicDBObject;
import com.mongodb.DBObject;
import com.mongodb.DBCursor;
import java.io.File;
import java.net.UnknownHostException;
import java.sql.*;

public class edx_to_moodle_section {
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
    static final String DB_URL = "jdbc:mysql://localhost/moodle";
    static final String USER = "root";
    static final String PASS = "root";
    public static void main(String[] args) throws ClassNotFoundException, UnknownHostException, SQLException {
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = null;
        conn = DriverManager.getConnection(DB_URL, USER, PASS);
        Statement stmt = conn.createStatement(); //mysql statement
        //To connect to mongodb server
        MongoClient mongoClient = new MongoClient("localhost", 27017);
        //Now connect to your databases
        DB db = mongoClient.getDB("xmodule");
        //System.out.println("Connection to Database Successfull");
        DBCollection coll = db.getCollection("modulestore");
        //System.out.println("Collection Selected Successfull");
        BasicDBObject query = new BasicDBObject("_id.category", "chapter");
        //BasicDBObject query = new BasicDBObject("_id.category", "course").append("_id.course", "CS201");
        DBCursor cursor = coll.find(query);
        String resulta = "", resultb = "";
        while (cursor.hasNext()) {
            DBObject tobj = cursor.next();
            resulta = tobj.get("_id").toString();
            resultb = tobj.get("metadata").toString();
        }
        //System.out.println(resulta);
        String[] temp1 = resulta.split(":");
        String resa = temp1[3];
        String[] resb = resa.split(",");
        String resc = resb[0];
        String resd = resc.substring(2, resc.length() - 2);
        System.out.println(resd);
        //System.out.println(resultb);
        String[] temp2 = resultb.split(":");
        String rese = temp2[1];
        String newsectionname = rese.substring(2, rese.length() - 2);
        System.out.println(newsectionname);
        cursor.close();
        String sql = "select * from mdl_course where idnumber = '" + resd + "'";
        //System.out.println(sql);
        ResultSet rs = stmt.executeQuery(sql);
        int id = 0;
        while (rs.next()) {
            id = rs.getInt("id");
        }
        //System.out.println(id);
        sql = "select * from mdl_course_sections where course = " + id + " and name!='null'";
        //sql = "select * from mdl_course_sections where course = 65 and name!='null'";
        rs = stmt.executeQuery(sql);
        String name = "";
        int flag = 1;
        while (rs.next()) {
            name = rs.getString("name");
            if (name.compareTo(newsectionname) == 0) flag = 0;
        }
        if (flag == 1) {
            //System.out.println(sql);
            rs = stmt.executeQuery(sql);
            sql = "select id from mdl_course_sections where section=0 and course = " + id;
            //sql ="select id from mdl_course_sections where section=0 and course = 65";
            rs = stmt.executeQuery(sql);
            int id1 = 0;
            while (rs.next()) {
                id1 = rs.getInt("id");
            }
            sql = "select * from mdl_course_sections where course = " + id + " and name!='null'";
            //sql = "select * from mdl_course_sections where course = 65 and name!='null'";
            rs = stmt.executeQuery(sql);
            while (rs.next()) {
                id1 = rs.getInt("id");
            }
            id1++;
            System.out.println(id1);
            sql = "update mdl_course_sections set name='" + newsectionname + "' where id=" + id1;
            stmt.execute(sql);
        }
    }
}