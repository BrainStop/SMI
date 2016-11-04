<?php
require_once( "../Lib/lib.php" );
require_once( "../Lib/db.php" );
require_once( "validationregex.php" );

$baseNextUrl = myGetBaseUrl();

$username = filter_input( INPUT_POST, 'username', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => $usernameRegex)) );

$password = filter_input( INPUT_POST, 'password', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => $passwordRegex)) );

$remember_me = filter_input( INPUT_POST, 'remember_me', FILTER_VALIDATE_BOOLEAN);

$user = myIsValid($username, $password, "basic");
if ($user > 0) {
    
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    
    if (isset($_SESSION['locationAfterAuth'])) {
        $baseNextUrl = $baseUrl;
        $nextUrl = $_SESSION['locationAfterAuth'];
    } else {
        $nextUrl = "index.php";
    }
} else {
    $nextUrl = "index.php?error=true&username=$username&remember_me=$remember_me";
}
header("Location: " . $baseNextUrl . $nextUrl);
?>