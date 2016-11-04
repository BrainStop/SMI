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
require_once( "./validationregex.php");

$baseNextUrl = myGetBaseUrl();

if (!isset($_SESSION)) {
    session_start();
}

dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

//Validade Data Received

$oldPassword = filter_input(
        INPUT_POST, 'oldPassword', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => $passwordRegex)));

$newPassword = filter_input(
        INPUT_POST, 'newPassword', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => $passwordRegex)));

$repNewPassword = filter_input(
        INPUT_POST, 'repNewPassword', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => $passwordRegex)));

$email = filter_input(
        INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$repEmail = filter_input(
        INPUT_POST, 'repEmail', FILTER_VALIDATE_EMAIL);

$set = "SET ";

if ((strcmp($oldPassword, "") != 0) &&
        (strcmp($newPassword, "") != 0) &&
        (strcmp($repNewPassword, "") != 0) &&
        (strcmp($newPassword, $repNewPassword) == 0)) {

    $querySelect = "SELECT password FROM `auth-basic` WHERE `id`=" . $_SESSION['id'];
    $result = mysql_query($querySelect);
    $row = mysql_fetch_array($result);

    if (strcmp($row['password'], $oldPassword) == 0) {
        $set .= " `password`='$newPassword' ";
    }
}
if ((strcmp($email, "") != 0) && (strcmp($repEmail, "") != 0) &&
        (strcmp($email, $repEmail) == 0)) {
    
    $querySelect = "SELECT email FROM `auth-basic`";
    $result = mysql_query($querySelect);
    
    if (mysql_num_rows($result) == 0) {
        if (strcmp($set, "SET ") == 0) {
            $set .= " `email`='$email'";
        } else {
            $set .= ", `email`='$email'";
        }
    }
}
if (strcmp($set, "SET ")) {
    $queryUpdate = "UPDATE `auth-basic` $set WHERE `id`=" . $_SESSION['id'];
    $sucess = mysql_query($queryUpdate);
}
if (file_exists($_FILES['userFile']['tmp_name']) || is_uploaded_file($_FILES['userFile']['tmp_name'])) {

    $queryDelMedia = "DELETE " .
            "`trabfinal-media`" .
            "FROM " .
            "`trabfinal-media` " .
            "INNER JOIN " .
            "`trabfinal-user_media` " .
            "ON " .
            "`trabfinal-media`.`idMedia`=`trabfinal-user_media`.`idMedia` " .
            "WHERE " .
            "`trabfinal-user_media`.`idUser`=" . $_SESSION['id'];

    mysql_query($queryDelMedia, $GLOBALS['ligacao']);
    dbDisconnect();

    $type = "profile";
    $idComment = $_SESSION['id'];
    include "./privatePHP/processFormUpload.php";
}
dbDisconnect();
header("Location: " . $baseNextUrl . "formUpdateUser.php");
