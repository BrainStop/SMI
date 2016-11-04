<?php
require_once '../Lib/db.php';
require_once '../Lib/lib.php';

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

$idSubComment = filter_input(INPUT_GET, 'idSubComment', FILTER_VALIDATE_INT);
$idEvent = filter_input(INPUT_GET, 'idEvent', FILTER_VALIDATE_INT);

$qDelSubComment = 
        "DELETE
            `trabfinal-comment` ,
            `trabfinal-media`
        FROM
                `trabfinal-comment` 
        LEFT JOIN 
                `trabfinal-comment_media`
        ON
                `trabfinal-comment_media`.`idComment`=`trabfinal-comment`.`idComment`
        LEFT JOIN
                `trabfinal-media`
        ON
                `trabfinal-media`.`idMedia`=`trabfinal-comment_media`.`idMedia`
        WHERE
                `trabfinal-comment`.`idComment`=$idSubComment";
        
dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$result = mysql_query($qDelSubComment, $GLOBALS['ligacao']);

dbDisconnect();

$baseNextUrl = myGetBaseUrl();
header("Location: " . $baseNextUrl . "eventPage.php?idEvent=$idEvent");
    
    
