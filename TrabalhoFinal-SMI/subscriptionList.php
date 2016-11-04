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
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="./js/subscriptionList.js"></script>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <title>Dota E-Sports Home Page</title>
    </head>
    <?php include './navbar.php'; ?>
    <body>
        <se
        <?php
        require_once '../lib/db.php';
        echo "<section class='content'>";
        
        dbConnect(ConfigFile);
        mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

        $idUser = $_SESSION['id'];

        $qSelCat = "SELECT idCategory FROM `trabfinal-category`";

        $rsSelCat = mysql_query($qSelCat, $GLOBALS['ligacao']);
        if ($rsSelCat) {
            echo "<table class='eventblock'>\n"
            . "    <tr>"
            . "        <th>Category</th>"
            . "        <th>Subscribed</th>"
            . "     </tr>";
            while ($rowSelCat = mysql_fetch_array($rsSelCat)) {
                $cat = $rowSelCat['idCategory'];
                
                $qSelSub = "SELECT `idCategory` FROM `trabfinal-subscription` WHERE `idCategory`='$cat' AND `idSubscriber`=$idUser";
                $rsSelSub = mysql_query($qSelSub, $GLOBALS['ligacao']);
                ?>
            <tr>
                <td>
                    <?php echo $cat; ?> <br>
                </td>
                <td>
                    <input type="checkbox" 
                           name="<?php echo $cat ?>"
                           <?php echo mysql_num_rows($rsSelSub)==1 ? "checked" : "" ?>
                           onchange="addRemCatgory(this)"/>
                </td>
            </tr>
            <?php
        }
        echo "</table>";
    }
    ?>
    <input type="hidden" id="idUser" value="<?php echo $idUser?>" />
</section>
</body>
</html>
