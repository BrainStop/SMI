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

$idEvent = filter_input(INPUT_GET, 'idEvent', FILTER_VALIDATE_INT);

if(!$idEvent) {
    header("Location: " . $baseNextUrl . "index.php");
    exit;
}

$qDelEvent = 
        "DELETE
            `trabfinal-event`,
            `event-comment`,
            `sub-comment`,
            `event-media`,
            `comment-media`,
            `subcomment-media`
        FROM
                `trabfinal-event`
        LEFT JOIN
                `trabfinal-event_comment`
        ON 
                `trabfinal-event`.`idEvent`=`trabfinal-event_comment`.`idEvent`
        LEFT JOIN
                `trabfinal-comment` AS `event-comment`
        ON
                `event-comment`.`idComment`=`trabfinal-event_comment`.`idComment`
        LEFT JOIN
                `trabfinal-comment_comment`
        ON
                `trabfinal-comment_comment`.`parentComment`=`event-comment`.`idComment`
        LEFT JOIN
                `trabfinal-comment` As `sub-comment`
        ON
            `trabfinal-comment_comment`.`childComment`=`sub-comment`.`idComment`
        LEFT JOIN
                `trabfinal-event_media`
        ON 
                `trabfinal-event_media`.`idEvent`=`trabfinal-event`.`idEvent`
        LEFT JOIN
                `trabfinal-media` AS `event-media`
        ON 
                `event-media`.`idMedia`=`trabfinal-event_media`.`idMedia`
        LEFT JOIN
                `trabfinal-comment_media` AS `comment-media-link`
        ON
                `comment-media-link`.`idComment` = `event-comment`.`idComment`
        LEFT JOIN 
                `trabfinal-media` AS `comment-media`
        ON
                `comment-media-link`.`idMedia`=`comment-media`.`idMedia`
        LEFT JOIN
                `trabfinal-comment_media` AS `subcomment-media-link`
        ON 
                `subcomment-media-link`.`idComment`=`sub-comment`.`idComment`
        LEFT JOIN
                `trabfinal-media` AS `subcomment-media`
        ON
                `subcomment-media-link`.`idMedia`=`subcomment-media`.`idMedia`
        WHERE 
                `trabfinal-event`.`idEvent`=$idEvent";
        
dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$result = mysql_query($qDelEvent, $GLOBALS['ligacao']);

$baseNextUrl = myGetBaseUrl();

header("Location: " . $baseNextUrl . "index.php");
    
dbDisconnect();