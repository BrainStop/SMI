<?php
require_once( "../Lib/lib.php" );
require_once( "./validationregex.php");

$baseNextUrl = myGetBaseUrl();

if (!isset($_SESSION)) {
    session_start();
}
//Validade Data Received
$username = filter_input(
        INPUT_POST, 'username', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => $usernameRegex)));

$password = filter_input(
        INPUT_POST, 'password', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => $passwordRegex)));

$email = filter_input(
        INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$valid = TRUE;
$usernameVal = "usernameVal=$username";
$emailVal = "emailVal=$email";
$captchaGet = "captchaErr=0";
$usernameGet = "usernameErr=0";
$passwordGet = "passwordErr=0";
$emailGet = "emailErr=0";
$userUsedGet = "userUsed=0";
$emailUsedGet = "emailUsed=0";
$imageGet     = "imageErr=0";

if ($_SESSION['captcha'] != $_POST['captcha']) {
    $captchaGet = "captchaErr=1";
    $valid = FALSE;
}
if (!isset($username) and $username == FALSE) {
    $usernameGet = "usernameErr=1";
    $valid = FALSE;
}
if (!isset($password) and $password == FALSE) {
    $passwordGet = "passwordErr=1";
    $valid = FALSE;
}
if (!isset($email) and $email == FALSE) {
    $emailGet = "emailErr=1";
    $valid = FALSE;
}
if(!file_exists($_FILES['userFile']['tmp_name']) || !is_uploaded_file($_FILES['userFile']['tmp_name'])) {
    $imageGet = "imageErr=1";
    $valid = FALSE;
}

if (!$valid) {
    $nextUrl = "index.php?$captchaGet&$usernameGet&$passwordGet&$emailGet&$usernameVal&$emailVal&$imageGet&r=1";
    header("Location: " . $baseNextUrl . $nextUrl);
    exit;
}

//Verify if the email and username already exist
require_once( "../Lib/db.php" );

dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$queryEmail = "SELECT * FROM `auth-basic` WHERE email='" . $email . "'";
$resultEmail = mysql_query($queryEmail, $GLOBALS['ligacao']);

$queryUser = "SELECT * FROM `auth-basic` WHERE name='" . $username . "'";
$resultUser = mysql_query($queryUser, $GLOBALS['ligacao']);

if (mysql_num_rows($resultUser) != 0) {
    $userUsedGet = "usernameUsed=1";
    $valid = FALSE;
}
if (mysql_num_rows($resultEmail) != 0) {
    $emailUsedGet = "emailUsed=1";
    $valid = FALSE;
}

if (!$valid) {
    $nextUrl = "index.php?$userUsedGet&$emailUsedGet&$usernameVal&$emailVal&r=1";
    header("Location: " . $baseNextUrl . $nextUrl);
    exit;
}

//INSERT Data into DataBase
$queryInsert = 'INSERT INTO `auth-basic` (name, password, email, valid) '
        . 'VALUES ("' . $username . '", "' . $password . '", "' . $email . '", 0);';

if (mysql_query($queryInsert, $GLOBALS['ligacao'])) {
    $queryid = 'SELECT  id FROM `auth-basic` WHERE email="' . $email . '"';
    $resultSetId = mysql_query($queryid, $GLOBALS['ligacao']);
    $regist = mysql_fetch_array($resultSetId);
    $id = $regist['id'];
    $authcode = time();
    $queryauth = 'INSERT INTO `auth-challenge` (challenge, id) '
            . 'VALUES (' . $authcode . ', ' . $id . ')';
    
    mysql_query($queryauth, $GLOBALS['ligacao']);
    $qiPermission = 'INSERT INTO `trabfinal-permissions` (role, user) ' .
            'VALUES (0, ' . $id . ');';
    mysql_query($qiPermission, $GLOBALS['ligacao']);
    
    dbDisconnect();
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    dbDisconnect();
    exit();
}
//Send email to verify account
require_once( "../Lib/lib-mail-v2.php" );

$accountData = simplexml_load_file( "./email/email.xml" );

$smtpServer     = (String)$accountData->smtpServer;
$useSSL         = (String)$accountData->useSSL;
$port           = (String)$accountData->port;
$timeout        = (double)$accountData->timeout;
$loginName      = (String)$accountData->loginName;
$frompassword   = (String)$accountData->password; 
$fromEmail      = (String)$accountData->fromEmail;
$fromName       = (String)$accountData->fromName;
$toList         = "Hotmail <".$email.">";
$ccList         = NULL;
$bccList        = NULL; 
$subject        = "Email Verification";
$message        = "Hi, ".$username." to verify this email click on the link "
        . $baseNextUrl . "/emailAuth.php?id=".$id."&code=".$authcode;
$showProtocol   = FALSE;
$caFileName     = NULL;

    $result = sendAuthEmail(
      $smtpServer,
      $useSSL,
      $port,
      $timeout,
      $loginName,
      $frompassword,
      $fromEmail,
      $fromName,
      $toList,
      $ccList,
      $bccList,
      $subject,
      $message,
      $showProtocol,
      $caFileName);
    
    $type = "profile";
    $idComment = $id;
    include "./privatePHP/processFormUpload.php";
    
    
    if ( $result==TRUE ) {
        $nextUrl = "acountCreated.php?username=$username";
        header("Location: " . $baseNextUrl . $nextUrl);
    }
    else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error / Email not sent.', true, 500);
        exit();
    }    