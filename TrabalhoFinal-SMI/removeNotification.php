<?php
require_once( "../Lib/db.php" );
require_once( "../Lib/lib.php" );
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] < 1) {
            header("Location: " . $baseNextUrl . "index.php?w=1");
            exit;
        }
    } else {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
}

dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$idNot = filter_input(INPUT_GET, 'idNot', FILTER_VALIDATE_INT);
$idEvent = filter_input(INPUT_GET, 'idEvent', FILTER_VALIDATE_INT);

if(!$idNot || !$idEvent){
    exit;
}

$queryNotification = "DELETE FROM `trabfinal-notification` WHERE `idNotification`=$idNot";

$resultNotification = mysql_query($queryNotification, $GLOBALS['ligacao']);

$baseNextUrl = myGetBaseUrl();

dbDisconnect();

header("Location: " . $baseNextUrl . "eventPage.php?idEvent=$idEvent");