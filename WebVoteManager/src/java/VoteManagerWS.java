
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import com.mysql.jdbc.jdbc2.optional.MysqlDataSource;
import java.sql.ResultSet;

/**
 *
 * @author Gonçalo Oliveira
 */
@WebService(serviceName = "VoteManagerWS", targetNamespace = "http://my.org/ns/")
public class VoteManagerWS {

    private Connection cn;
    private MysqlDataSource dataSource;
    private PreparedStatement stmt;
    private static final String T_EVENT = "`trabfinal-event`";
    private static final String T_COMMENT = "`trabfinal-comment`";
    private static final String C_EVENT = "idEvent";
    private static final String C_COMMENT = "idComment";

    public VoteManagerWS() {
        try {
            dataSource = new MysqlDataSource();
            dataSource.setUser("root");
            dataSource.setPassword("");
            dataSource.setServerName("localhost/smi?");
        } catch (Exception ex) {
            System.err.print("Error:" + ex);
        }
    }

    private void connect() {
        try {
            cn = dataSource.getConnection();
        } catch (SQLException ex) {

            System.out.println("SQLException: " + ex.getMessage());
            System.out.println("SQLState: " + ex.getSQLState());
            System.out.println("VendorError: " + ex.getErrorCode());
        }
    }

    private void disconnect() {
        try {
            if (stmt != null) {
                stmt.close();
            }
        } catch (Exception ex) {
            System.out.println("Error: " + ex);
        }
        try {
            if (cn != null) {
                cn.close();
            }
        } catch (Exception ex) {
            System.out.println("Error: " + ex);
        }
    }

    @WebMethod(operationName = "upvoteEvent")
    public String upvoteEvent(@WebParam(name = "identifier") int id) {
        connect();
        updateTable(id, T_EVENT, C_EVENT, 1);
        String res = getVote(id, T_EVENT, C_EVENT);
        disconnect();
        return res; 
    }

    @WebMethod(operationName = "upVoteComment")
    public String upVoteComment(@WebParam(name = "identifier") int id) {
        connect();
        updateTable(id, T_COMMENT, C_COMMENT, 1);
        String res = getVote(id, T_COMMENT, C_COMMENT);
        disconnect();
        return res;
    }

    @WebMethod(operationName = "downVoteEvent")
    public String downVoteEvent(@WebParam(name = "identifier") int id) {
        connect();
        updateTable(id, T_EVENT, C_EVENT, -1);
        String res = getVote(id, T_EVENT, C_EVENT);
        disconnect();
        return res;
    }

    @WebMethod(operationName = "downVoteComment")
    public String downVoteComment(@WebParam(name = "identifier") int id) {
        connect();
        updateTable(id, T_COMMENT, C_COMMENT, -1);
        String res = getVote(id, T_COMMENT, C_COMMENT);
        disconnect();
        return res;
    }

    private void updateTable(int id, String table,
            String colum, int vote) {

        String query = "UPDATE " + table + " SET votes = votes + " + vote + " "
                + "WHERE " + colum + "='" + id + "'";
        try {

            stmt = cn.prepareStatement(query);
            stmt.executeUpdate();
        } catch (SQLException ex) {
            Logger.getLogger(
                    VoteManagerWS.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private String getVote(int id, String table, String colum) {
        String query = "SELECT votes FROM " + table + " WHERE " + colum + "=" + id;
        ResultSet rs = null;
        try {

            stmt = cn.prepareStatement(query);
            rs = stmt.executeQuery();
        } catch (SQLException ex) {
            Logger.getLogger(
                    VoteManagerWS.class.getName()).log(Level.SEVERE, null, ex);
        }
        if (rs != null) {
            try {
                if (rs.next()) {
                    return rs.getString("votes") + "|" + id + "|" + colum.substring(2);
                }
            } catch (SQLException ex) {
                Logger.getLogger(VoteManagerWS.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        return "-1|error|" + colum.substring(2);
    }
}
