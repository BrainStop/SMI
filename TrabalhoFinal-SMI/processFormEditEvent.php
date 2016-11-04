<?php
require_once( "../Lib/db.php" );
require_once( "../Lib/lib.php" );

$baseNextUrl = myGetBaseUrl();

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

$cat = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_STRING);
$subCat = filter_input(INPUT_POST, 'subCat', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$idEvent = filter_input(INPUT_POST, 'idEvent', FILTER_VALIDATE_INT);

if(!isset($cat) && !isset($subCat) && !isset($title) && !isset($description)
        && !$cat && !$subCat && !$title && !$description) {
    header("Location: " . $baseNextUrl . "index.php");
    dbDisconnect();
    exit();
}

$catEsc = mysql_real_escape_string($cat);
$subCatEsc = mysql_real_escape_string($subCat);
$titleEsc = mysql_real_escape_string($title);
$descriptionEsc = mysql_real_escape_string($description);

$queryValidadeCat = "SELECT * FROM `trabfinal-categorylink` ".
        "WHERE idCategory='$catEsc' and idSubCategory='$subCatEsc';";
$vCResult = mysql_query($queryValidadeCat);

if(mysql_num_rows($vCResult) !== 1) {
    header("Location: " . $baseNextUrl . "index.php");
    dbDisconnect();
    exit();
}


$queryUpdateEvent = "UPDATE `trabfinal-event` " .
                    "SET ".
                        "`title`='$titleEsc', `description`='$descriptionEsc'," .
                        " `idCategory`='$catEsc', `idSubCategory`='$subCatEsc'" .
                    "WHERE " .
                        "`idEvent`=$idEvent;";

if (mysql_query($queryUpdateEvent, $GLOBALS['ligacao'])) {

    if (file_exists($_FILES['userFile']['tmp_name']) || is_uploaded_file($_FILES['userFile']['tmp_name'])) {
            $queryDelMedia = "DELETE " .
                     "`trabfinal-media`" .
                     "FROM " . 
                        "`trabfinal-media` " .
                     "INNER JOIN " .
                        "`trabfinal-event_media` ".
                     "ON ".
                        "`trabfinal-media`.`idMedia`=`trabfinal-event_media`.`idMedia` ".
                     "WHERE ".
	                "`trabfinal-event_media`.`idEvent`=$idEvent";
            
            mysql_query($queryDelMedia, $GLOBALS['ligacao']);
            dbDisconnect();

            $type = "event";
            $idComment = $idEvent;
            include "./privatePHP/processFormUpload.php";
    }
}
else {
    header("Location: " . $baseNextUrl . "index.php");
    exit();
}
header("Location: " . $baseNextUrl . "eventPage.php?idEvent=$idEvent");


