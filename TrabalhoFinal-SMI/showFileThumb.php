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
require_once( "../Lib/db.php" );

// TODO validate input data
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
//TODO
$type = filter_input(INPUT_GET, 'type');

// Read from the data base details about the file
$fileDetails = myGetFileDetailsComment($type, $id);

$thumbFileNameAux = $fileDetails['thumbFileName'];
$thumbMimeFileName = $fileDetails['thumbMimeFileName'];
$thumbTypeFileName = $fileDetails['thumbTypeFileName'];

header("Content-type: $thumbMimeFileName/$thumbTypeFileName");
header("Content-Length: " . filesize($thumbFileNameAux));

$thumbFileHandler = fopen($thumbFileNameAux, 'rb');
fpassthru($thumbFileHandler);
fclose($thumbFileHandler);
?>