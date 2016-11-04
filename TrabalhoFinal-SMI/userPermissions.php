<?php 
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] < 3) {
            header("Location: " . $baseNextUrl . "index.php?w=1");
            exit;
        }
    } else {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <script type="text/javascript" src="./js/userPermissions.js"></script>
        <title>Dota Dungeon Home Page</title>
    </head>
    <body>
        <?php include './navbar.php' ?> 
        <section class="content">
            <table class="eventBlock">
                <tr>
                    <th>Name</th>
                    <th>Email</th> 
                    <th>Valid</th>
                    <th>Comments</th>
                    <th>Comment Votes</th>
                    <th>Events</th>
                    <th>Comment Events</th>
                    <th>Role</th>
                    <th>New Role</th>
                </tr>
                <?php
                require_once( "../Lib/db.php" );
                dbConnect(ConfigFile);
                mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

                $query = "SELECT 
                            `auth-basic`.`id` AS userID,
                            `name`,
                            `email`,
                            `valid`, 
                            `role`,
                            `trabfinal-roles`.`friendlyName`,
                            `SQ_cmnt`.`votes_cmnt`,
                            `SQ_cmnt`.`comments`,
                            `SQ_event`.`votes_event`, 
                            `SQ_event`.`events`
                        FROM 
                                `auth-basic` 
                        LEFT JOIN 
                                `trabfinal-permissions` 
                        ON
                                `auth-basic`.`id`=`trabfinal-permissions`.`user`
                        LEFT JOIN 
                                `trabfinal-roles`
                        ON
                                `trabfinal-roles`.id=`trabfinal-permissions`.`role`
                        LEFT JOIN (
                            SELECT
                                `creator`,
                                SUM(`votes`) AS `votes_cmnt`, 
                                COUNT(`idComment`) AS `Comments`
                            FROM
                                `trabfinal-comment`
                            GROUP BY
                                `creator`
                        ) AS `SQ_cmnt` ON `SQ_cmnt`.`creator`=`auth-basic`.`id`
                        LEFT JOIN (
                            SELECT
                                `creator`,
                                SUM(`votes`) AS `votes_event`, 
                                COUNT(`idEvent`) AS `events`
                            FROM
                                `trabfinal-event`
                            GROUP BY
                                `creator`
                        ) AS `SQ_event` ON `SQ_event`.`creator`=`auth-basic`.`id`";

                $result = mysql_query($query, $GLOBALS['ligacao']);

                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        $role = $row['role'];
                        echo "<tr id='" . $row['userID'] . "'>"
                        . "<td>" . $row['name'] . "</td>"
                        . "<td>" . $row['email'] . "</td>"
                        . "<td>" . $row['valid'] . "</td>"
                        . "<td>" . (isset($row['comments']) ? $row['comments'] : "0") . "</td>"
                        . "<td>" . (isset($row['votes_cmnt']) ? $row['comments'] : "0") . "</td>"
                        . "<td>" . (isset($row['events']) ? $row['comments'] : "0") . "</td>"
                        . "<td>" . (isset($row['votes_event']) ? $row['comments'] : "0") . "</td>"
                        . "<td name='friendlyName'>" . $row['friendlyName'] . "</td>"
                        . "<td>"
                        . "    <select name='role'  onchange='SelectRoleChange(" . $row['userID'] . ")'>"
                        . "        <option value='0'" . ($row['role'] == 0 ? "selected" : "") . ">Guest</option>"
                        . "        <option value='1'" . ($row['role'] == 1 ? "selected" : "") . ">User</option>"
                        . "        <option value='2'" . ($row['role'] == 2 ? "selected" : "") . ">Supporter</option>"
                        . "        <option value='3'" . ($row['role'] == 3 ? "selected" : "") . ">Admin</option>"
                        . "    </select>"
                        . "</td>"
                        . "</tr>";
                    }
                }
                dbDisconnect();
                ?>
            </table>
        </section>
    </body>
</html>
