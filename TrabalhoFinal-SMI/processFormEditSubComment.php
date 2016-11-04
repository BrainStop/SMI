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
        if ($_SESSION['role'] < 2) {
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

$comment = filter_input(INPUT_POST, 'comment');
$idComment = filter_input(INPUT_POST, 'idComment', FILTER_VALIDATE_INT);

if (!isset($comment) && !isset($idComment) &&
        !$comment && !$idComment) {
    header("Location: " . $baseNextUrl . "index.php?");
    exit;
}

if (!file_exists($_FILES['userFile']['tmp_name']) ||
        !is_uploaded_file($_FILES['userFile']['tmp_name'])) {
    if (strcmp($comment, "") == 0) {
        header("Location: " . $baseNextUrl . "index.php?");
        exit;
    }
}

$commentEsc = mysql_real_escape_string($comment);

$queryUpdateComment = "UPDATE `trabfinal-comment` " .
                    "SET ".
                        "`contents`='$commentEsc' " .
                    "WHERE " .
                        "`idComment`=$idComment;";

echo $queryUpdateComment;

if (mysql_query($queryUpdateComment, $GLOBALS['ligacao'])) {

    if (file_exists($_FILES['userFile']['tmp_name']) || is_uploaded_file($_FILES['userFile']['tmp_name'])) {
            $queryDelComment = "DELETE " .
                     "`trabfinal-media`" .
                     "FROM " . 
                        "`trabfinal-media` " .
                    "INNER JOIN " .
                        "`trabfinal-comment_media` " .
                    "ON " .
                        "`trabfinal-comment_media`.`idMedia`=`trabfinal-media`.`idMedia` " .
                     "WHERE " .
	                "`trabfinal-comment_media`.`idComment`=$idComment";
            
            mysql_query($queryDelComment, $GLOBALS['ligacao']);
            dbDisconnect();

            $type = "subcomment";
            include "./privatePHP/processFormUpload.php";
    }
}

dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$queryEvent = "SELECT * FROM `trabfinal-comment_comment` INNER JOIN `trabfinal-event_comment`".
        " On `parentComment`=`idComment` WHERE `childComment`='$idComment'";
$resultSet = mysql_query($queryEvent, $GLOBALS['ligacao']);
$row = mysql_fetch_array($resultSet);
$idEvent = $row['idEvent'];

dbDisconnect();

$baseNextUrl = myGetBaseUrl();

header("Location: " . $baseNextUrl . "eventPage.php?idEvent=$idEvent");

