<?php
    require_once( "../Lib/db.php" );

    dbConnect(ConfigFile);
    mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);
    
    $usernameRegex    = "/^([a-zA-Z0-9-_]{4,})/";
    $passwordRegex = "/^([a-zA-Z0-9-_]{4,})/";
    $emailRegex    = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
    $checkboxRegex = '/\bon\b|\boff\b/i';
    
    function sql_InjectionFilter( $data ) {
    // remove whitespaces from begining and end
    $trimData = trim($data);
    
    // apply stripslashes to pevent double escape if magic_quotes_gpc is enabled
    if(get_magic_quotes_gpc()) {
        $trimData = stripslashes( $trimData );
    }
    // connection is required before using this function
    // TODO FIX THIS
    //$SafeData = mysqli_real_escape_string($conn, $trimData );
    return $trimData;
    }
?>
