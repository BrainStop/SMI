<?php
    header('Content-Type: text/html; charset=utf-8');
    
    require_once( "../Lib/lib.php");
    require_once("../Lib/db.php");
    
    dbConnect(ConfigFile);

    mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);
    
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
    $code = filter_input(INPUT_GET, 'code', FILTER_VALIDATE_FLOAT);
    
    $queryId = 'SELECT id, challenge FROM `auth-challenge` where id='.$id;
    $rs = mysql_query($queryId);
    $rowsId = mysql_fetch_array($rs);
    $dbCode = $rowsId['challenge'];
    
    if($dbCode == $code) {
        $insertAuth = 'UPDATE `auth-basic` SET valid=1 WHERE id='.$id;
        $queryUsername = 'SELECT ´name´ FROM ´auth-basic´ WHERE id='.$id;
        $rsUsername = mysql_query($insertAuth);
        $rowUsername = mysql_fetch_array($rsUsername);
        if(mysql_query($insertAuth)) {
            $nextUrl = "acountValid.php?v=1&username=" . $rowUsername['name'];
        } else {
            $nextUrl = "acountValid.php?v=0&username=" . $rowUsername['name'];
        }
        dbDisconnect();
        $baseNextUrl = myGetBaseUrl();
        header("Location: " . $baseNextUrl . $nextUrl);
    }   