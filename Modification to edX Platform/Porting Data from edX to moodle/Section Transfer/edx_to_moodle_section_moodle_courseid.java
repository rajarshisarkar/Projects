import com.mongodb.MongoClient;
import com.mongodb.DB;
import com.mongodb.DBCollection;
import com.mongodb.BasicDBObject;
import com.mongodb.DBObject;
import com.mongodb.DBCursor;
import java.io.File;
import java.net.UnknownHostException;
import java.sql.*;

public class edx_to_moodle_section_moodle_courseid {
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
        //System.out.println(resd);
        //System.out.println(resultb);
        String[] temp2 = resultb.split(":");
        String rese = temp2[1];
        String newsectionname = rese.substring(2, rese.length() - 2);
        //System.out.println(newsectionname);
        cursor.close();
        String sql = "select * from mdl_course where idnumber='" + resd + "'";
        ResultSet rs = stmt.executeQuery(sql);
        int courseid = 0;
        while (rs.next()) {
            courseid = rs.getInt("id");
        }
        System.out.print(courseid);
    }
}