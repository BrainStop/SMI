<?php
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] < 2) {
            header("Location: " . $baseNextUrl . "index.php?w=1");
            exit;
        }
    } else {
        header("Location: " . $baseNextUrl . "index.php?w=1");
        exit;
    }
}
?>
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
            <script type="text/javascript" src="js/formAddEvent.js"></script>
            <form
                action="processFormAddEvent.php" 
                method="POST"
                enctype="multipart/form-data"
                name="form"
                onsubmit="return validateForm()">
                <table class="eventBlock">
                    <tr>
                        <td> 
                            Cat:
                            <select name="cat" onchange="changeSubCatSelect(this)">
                                <?php
                                require_once( "../Lib/lib.php" );
                                require_once( "../Lib/db.php" );

                                $configurations = getConfiguration();

                                dbConnect(ConfigFile);
                                mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

                                $queryCat = "SELECT * FROM `trabfinal-category`";
                                $rsCat = mysql_query($queryCat, $GLOBALS['ligacao']);
                                $first = TRUE;
                                while ($rowCat = mysql_fetch_array($rsCat)) {
                                    if ($first) {
                                        $cat = $rowCat['idCategory']; //Saves first Cat Value
                                        $first = FALSE;
                                    }
                                    echo '<option value="' . $rowCat['idCategory'] . '">' . $rowCat['idCategory'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>    
                        <td>
                            SubCat:
                            <select id="subCat" name="subCat">
                                <?php
                                $querySubCat = "SELECT * FROM `trabfinal-categorylink` WHERE `idCategory`='" . $cat . "'";
                                $rsquerySubCat = mysql_query($querySubCat, $GLOBALS['ligacao']);
                                while ($rowquerySubCat = mysql_fetch_array($rsquerySubCat)) {
                                    echo '<option value="' . $rowquerySubCat['idSubCategory'] . '">' . $rowquerySubCat['idSubCategory'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Insert Tittle: <input type="text" name="title">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea 
                                name="description" 
                                placeholder='Type description here...' 
                                cols="68" 
                                rows="8"></textarea><br>
                            <input 
                                type="hidden" 
                                name="MAX_FILE_SIZE" 
                                value="<?php echo $configurations['maxFileSize'] ?>">
                            <input 
                                type="file" 
                                name="userFile" 
                                size="64"><br>
                            <input type="submit" name="Submit" value="Add Event!">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
    </body>
</html>
