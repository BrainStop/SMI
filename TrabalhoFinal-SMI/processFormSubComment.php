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

$parentComment = filter_input(INPUT_POST, 'parentComment', FILTER_VALIDATE_INT);
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
$idEvent = filter_input(INPUT_POST, 'idEvent', FILTER_VALIDATE_INT);
$idCreator = $_SESSION['id'];

if(!isset($idEvent) && !isset($comment) && !isset($parentComment) &&
        !$idEvent && !$comment && !$parentComment) {
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


$commentESC = mysql_real_escape_string($comment);

$queryInsertComment = "INSERT INTO `trabfinal-comment` (`contents`, `creator`) VALUES"
        . "('$commentESC', $idCreator);";


if (mysql_query($queryInsertComment, $GLOBALS['ligacao'])) {
    $childComment = mysql_insert_id();
    
    $queryLinkComment = "INSERT INTO `trabfinal-comment_comment` (`parentComment`, `childComment`) VALUES"
        . "($parentComment, $childComment);";
    
    echo $queryLinkComment;
    
    mysql_query($queryLinkComment, $GLOBALS['ligacao']);
    
    if(!file_exists($_FILES['userFile']['tmp_name']) || !is_uploaded_file($_FILES['userFile']['tmp_name'])) {
        
        $baseNextUrl = myGetBaseUrl();
        header("Location: " . $baseNextUrl . "eventPage.php?idEvent=$idEvent");
        dbDisconnect();
        exit();
    }
}
dbDisconnect();
// To be compatible with processFromUpload
$type = "subcomment";
$idComment = $childComment;
include './privatePHP/processFormUpload.php';