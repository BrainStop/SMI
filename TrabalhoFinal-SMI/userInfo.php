<?php
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] < 0) {
            header("Location: " . $baseNextUrl . "index.php?w=1");
            exit;
        }
    } else {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
}

require_once( "../Lib/lib.php" );
require_once( "../Lib/db.php" );

if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: loginForm.php");
        exit;
    }
}
?>
<p>
    Hi,<b> <?php echo $_SESSION['username']; ?></b>!<br>
    <?php
    // Get role data
    dbConnect(ConfigFile);
    mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

    $query = "SELECT ".
            "   `friendlyName` ".
            "FROM ".
            "   `trabfinal-roles`".
            "WHERE ".
            "    `id`=" . $_SESSION['role'];
    $resultSet = mysql_query($query, $GLOBALS['ligacao']);
    $row = mysql_fetch_array($resultSet);
    ?>
    Profile Type: <?php echo $row['friendlyName']; ?><br>
</p>
<a href="logout.php">Logout</a>
<br>
<section>
<h5>User Feed</h5>
    <ul>
    <?php
    $queryNotification = "SELECT "
            . "    * "
            . "FROM "
            . "    `trabfinal-notification` "
            . "INNER JOIN "
            . "    `trabfinal-subscription` "
            . "ON "
            . "    `trabfinal-subscription`.`idSubscription`=`trabfinal-notification`.`idSubscription` "
            . "INNER JOIN "
            . "    `trabfinal-event` "
            . "ON "
            . "    `trabfinal-event`.`idEvent`=`trabfinal-notification`.`idEvent`"
            . "WHERE "
            . "    `trabfinal-subscription`.`idSubscriber` = " . $_SESSION['id'];

    $resultSetNotification = mysql_query($queryNotification, $GLOBALS['ligacao']);

    if($resultSetNotification) {

        $baseUrl = myGetBaseUrl();

        while($rowNotification = mysql_fetch_array($resultSetNotification)) {
            echo  "<li>"
                    . "<a href='".$baseUrl."removeNotification.php?idEvent=".$rowNotification['idEvent']."&idNot=".$rowNotification['idNotification']."'>".$rowNotification['title']."</a><br>"
                . "</li>";
        }
    }
    ?>
    </ul>
</section>