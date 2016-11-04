<?php
    require_once( "../Lib/db.php" );
    require_once( "validationregex.php" );

    dbConnect(ConfigFile);
    mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

    header('Content-Type: text/html; charset=utf-8');
    
    $cat = sql_InjectionFilter( filter_input(INPUT_GET, 'cat') );
    
    $options = "";
    
    $subCatquery = "SELECT * FROM `trabfinal-categorylink` WHERE `idCategory`='" . $cat . "'";
    $subCatRS = mysql_query($subCatquery);

    if ($subCatRS) {    
        while ($subCatResult = mysql_fetch_array($subCatRS)) {
          $subCat = $subCatResult['idSubCategory'];
          $options .="|" . $subCat;
        }
    }

    dbDisconnect();

    echo $options;
?>