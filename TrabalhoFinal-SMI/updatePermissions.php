<?php
header('Content-Type: text/html; charset=utf-8');

$user = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
$role = filter_input(INPUT_GET, 'role', FILTER_VALIDATE_INT);
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
require_once( "../Lib/db.php" );

dbConnect(ConfigFile);

mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$update = "UPDATE `trabfinal-permissions` SET `role`=$role WHERE `user`=$user";
$updateResult = mysql_query($update);

if($updateResult) {
    $response = "1";
    if(strcmp($_SESSION['id'], $user) == 0 ) {
        $_SESSION['role'] = $role;
    }
}else {
    $response = "0";
}
dbDisconnect();
echo "$response@$user";
?>
