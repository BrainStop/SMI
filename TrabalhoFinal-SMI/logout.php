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
  session_start();
  session_destroy();
  $nextUrl = 'index.php';
  $baseNextUrl = myGetBaseUrl();
  header("Location: " . $baseNextUrl . $nextUrl);
?>