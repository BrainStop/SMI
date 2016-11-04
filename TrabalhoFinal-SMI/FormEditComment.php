<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <script type="text/javascript" src="./js/formAddEvent.js"></script>
    </head>
    <body>
        <?php include './navbar.php' ?> 
        <section class="content">
        
        <?php
        require_once '../Lib/db.php';
        require_once( "../Lib/lib.php" );


        $configurations = getConfiguration();
        
        dbConnect(ConfigFile);
        mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

        $idComment = filter_input(INPUT_GET, 'idComment', FILTER_VALIDATE_INT);
        $queryComment = "SELECT * FROM `trabfinal-comment` WHERE `idComment`=$idComment;";

        $resultComment = mysql_query($queryComment, $GLOBALS['ligacao']);
        
        $rowComment = mysql_fetch_array($resultComment);

        ?>
        <form 
            enctype="multipart/form-data"
            action="processFormEditComment.php"
            method="POST"
            name="FormUpload">
            <textarea 
                name="comment" 
                placeholder='Type comment here...' 
                cols="45" 
                rows="4"><?php echo $rowComment['contents']?></textarea><br>
            <input 
                type="hidden" 
                name="MAX_FILE_SIZE" 
                value="<?php echo $configurations['maxFileSize'] ?>">
            <input 
                type="hidden" 
                name="parentComment" 
                value="<?php echo $idComment ?>">
            <input 
                type="file" 
                name="userFile" 
                size="64"><br>
            <input type="submit" name="Submit" value="Edit Comment!">
            <input type="hidden" name="idComment" value="<?php echo $idComment ?>">
        </form>
        </section>
    </body>
</html>
