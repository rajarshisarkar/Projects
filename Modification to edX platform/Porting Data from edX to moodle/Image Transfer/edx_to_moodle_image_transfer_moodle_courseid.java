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

public class edx_to_moodle_image_transfer_moodle_courseid {
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
        String resd = resc.substring(2, resc.length() - 2);
        //System.out.println(resd);
        String sql = "select * from mdl_course where idnumber='" + resd + "'";
        ResultSet rs = stmt.executeQuery(sql);
        int courseid = 0;
        while (rs.next()) {
            courseid = rs.getInt("id");
        }
        System.out.print(courseid);
    }
}