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
                action="processFormEditEvent.php" 
                method="POST"
                name="form"
                onsubmit="return validateForm()"
                enctype="multipart/form-data">
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

                                $idEvent = filter_input(INPUT_GET, 'idEvent', FILTER_VALIDATE_INT);

                                $qPrevEvent = "SELECT * FROM `trabfinal-event` WHERE `idEvent`=$idEvent;";

                                $rsPrevEvent = mysql_query($qPrevEvent, $GLOBALS['ligacao']);

                                $rowPrevEvent = mysql_fetch_array($rsPrevEvent);


                                //TODO VALIDATIONS

                                $queryCat = "SELECT * FROM `trabfinal-category`";
                                $rsCat = mysql_query($queryCat, $GLOBALS['ligacao']);
                                while ($rowCat = mysql_fetch_array($rsCat)) {
                                    if ($rowPrevEvent['idCategory'] == $rowCat['idCategory']) {
                                        $cat = $rowCat['idCategory'];
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo '<option value="' . $rowCat['idCategory'] . '" ' .
                                    $selected . '>' . $rowCat['idCategory'] . '</option>';
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
                                    echo '<option value="' . $rowquerySubCat['idSubCategory'] . '" ' .
                                    ($rowPrevEvent['idSubCategory'] == $rowquerySubCat['idSubCategory'] ? ' selected' : '') .
                                    '>' . $rowquerySubCat['idSubCategory'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Insert Tittle: <input type="text" name="title" value="<?php echo $rowPrevEvent['title']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea 
                                name="description" 
                                placeholder='Type description here...'
                                cols="68" 
                                rows="8"><?php echo $rowPrevEvent['description']; ?></textarea><br>
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
                <input type="hidden" name="idEvent" value="<?php echo $idEvent ?>">
            </form>
        </section>
    </body>
</html>
