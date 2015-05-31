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

public class edx_to_moodle_send_pdf_get_courseid {
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
        //System.out.println(resh);
        cursor.close();
    }
}