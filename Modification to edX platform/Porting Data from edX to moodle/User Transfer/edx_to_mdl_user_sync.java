import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
public class edx_to_mdl_user_sync {
	// JDBC driver name and database URL
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
	static final String DB_URL_mdl = "jdbc:mysql://localhost/moodle";
	//  Database credentials
	static final String USER = "root";
	static final String PASS = "root";
	public static void main(String[] args) throws ClassNotFoundException {
		Class.forName("com.mysql.jdbc.Driver");
		Class.forName("org.sqlite.JDBC");
		Connection conn_edx = null;
		Connection conn_edx1 = null;
		//   Connection conn_edx1 = null;
		Connection conn_mdl = null;
		Connection conn_mdl1 = null;
		Statement stmt = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			try {
				// create a database connection
				conn_edx = DriverManager.getConnection("jdbc:sqlite:/home/rajarshi/edx_all/db/edx.db");
				Statement statement = conn_edx.createStatement();
				statement.setQueryTimeout(30); // set timeout to 30 sec.
				ResultSet rs1 = statement.executeQuery("select * from auth_user where id = (select max(id) from auth_user) ");
				while (rs1.next()) {
					// read the result set
					conn_edx1 = DriverManager.getConnection("jdbc:sqlite:/home/rajarshi/edx_all/db/edx.db");
					Statement st = conn_edx1.createStatement();
					st.setQueryTimeout(30);
					ResultSet rs5 = st.executeQuery("select * from auth_userprofile where id = (select max(id) from auth_userprofile) ");
					String fullName = rs5.getString("name");
					String[] splitStr = fullName.split("\\s+");
					String firstName = splitStr[0];
					String lastName = splitStr[splitStr.length - 1];
					conn_edx1.close();
					String username = rs1.getString("username");
					String email = rs1.getString("email");
					System.out.println("Username = " + username);
					String password = "$2y$10$p11/5aZ3y6yf1YnfArefNOrEHm1qqYz9nxfcBqx6tkVbIfBY9gp7K";
					//;
					conn_mdl1 = DriverManager.getConnection(DB_URL_mdl, USER, PASS);
					stmt = conn_mdl1.createStatement();
					String sql1;
					int flag = -39;
					ResultSet rs2 = stmt.executeQuery("select * from moodle.mdl_user");
					while (rs2.next()) {
						String tst_email = rs2.getString("email");
						if (tst_email.equals(email)) {
							flag = 1001;
						}
					}
					if (flag != 1001) {
						sql1 = "insert into moodle.mdl_user(confirmed,mnethostid,username,password,firstname,lastname,email,city,country) values (1,1,'" + username + "','" + password + "','" + firstName + "','" + lastName + "','" + email + "','cityname','IN')";
						System.out.println(sql1);
						//ResultSet rs = stmt.executeQuery(sql1);
						stmt.executeUpdate(sql1);
						conn_mdl1.close();
						stmt.close();
					} else {
						System.out.println("\n user already exists");
					}
				}
			} catch (SQLException e) {
				// if the error message is "out of memory", it probably means no database file is found
				System.err.println(e.getMessage());
			} finally {
				try {
					if (conn_edx != null) conn_edx.close();
				} catch (SQLException e) {
					// connection close failed.
					System.err.println(e);
				}
			}
			System.out.println("Connecting to database...");
			conn_mdl = DriverManager.getConnection(DB_URL_mdl, USER, PASS);
			//STEP 6: Clean-up environment
			//rs.close();
			stmt.close();
			conn_mdl.close();
		} catch (SQLException se) {
			//Handle errors for JDBC
			se.printStackTrace();
		} catch (Exception e) {
			//Handle errors for Class.forName
			e.printStackTrace();
		} finally {
			//finally block used to close resources
			try {
				if (stmt != null) stmt.close();
			} catch (SQLException se2) {} // nothing we can do
			try {
				if (conn_mdl != null) conn_mdl.close();
			} catch (SQLException se) {
				se.printStackTrace();
			} //end finally try
		} //end try
		System.out.println("Goodbye!");
	}
}