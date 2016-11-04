<?php
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] < 1) {
            header("Location: " . $baseNextUrl . "index.php?w=1");
            exit;
        }
    } else {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
}

require_once '../Lib/db.php';

header('Content-Type: text/html; charset=utf-8');

dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);


$idUser = filter_input(INPUT_GET, 'idUser', FILTER_VALIDATE_INT);
$idCat  = filter_input(INPUT_GET, 'idCat');
$add = filter_input(INPUT_GET, 'add', FILTER_VALIDATE_BOOLEAN);

if( is_null($idUser) || is_null($idCat) || is_null($add) ){
    echo "error" ;
    exit;
}

if($add) {
    $query = "INSERT INTO `trabfinal-subscription` (`idCategory`, `idSubscriber`) VALUES ('$idCat', $idUser);";
} else {
    $query = "DELETE FROM `trabfinal-subscription` WHERE `idCategory`='$idCat' AND `idSubscriber`=$idUser;";
}
$result = mysql_query($query, $GLOBALS['ligacao']);

dbDisconnect();

echo(result);