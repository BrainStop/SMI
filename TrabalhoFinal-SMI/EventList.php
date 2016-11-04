<?php
require_once( "../Lib/db.php" );
require_once( "validationregex.php" );

dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$catArg = sql_InjectionFilter(filter_input(INPUT_POST, 'cat'));
$subCatArg = sql_InjectionFilter(filter_input(INPUT_POST, 'subCat'));
$orderArg = sql_InjectionFilter(filter_input(INPUT_POST, 'order'));
?>
<script type="text/javascript" src="./js/eventList.js"></script>
<form class="search" method="POST" action="index.php">
    <select name="cat" onchange="changeSubCatSelect(this)">
        <option value="">Show All</option>
        <?php
        $catQuery = "SELECT * FROM `trabfinal-category`";
        $catRS = mysql_query($catQuery, $GLOBALS['ligacao']);
        if ($catRS) {
            while ($catRsult = mysql_fetch_array($catRS)) {
                $cat = $catRsult['idCategory'];
                echo "<option value='" . $cat . "'>" . $cat . "</option>\n";
            }
        }
        ?>
    </select>

    <select id="subCat" name="subCat">
        <option value="">Show All</option>
    </select>

    <select id="order" name="order">
        <option value="recent">Recent</option>
        <option value="older">Older</option>
        <option value="best">Best</option>
        <option value="alphabeticOrder">A-Z Order</option>
    </select>

    <input class="buttonDark" type='submit' value='Search'/>

</form>
<?php
$whereClause = "";
$orderClause = "";

if ($catArg != "" && $subCatArg != "") {
    $whereClause = "WHERE `idCategory`='" . $catArg . "' "
            . "AND " . "`idSubCategory`='" . $subCatArg . "'";
} else if ($catArg != "" && $subCatArg == "") {
    $whereClause = "WHERE `idCategory`='" . $catArg . "'";
}

switch ($orderArg) {
    case "recent":
        $orderClause .= " ORDER BY `pubDate` DESC";
        break;
    case "older":
        $orderClause .= " ORDER BY `pubDate` ASC";
        break;
    case "best":
        $orderClause .= " ORDER BY `votes` DESC";
        break;
    case "alphabeticOrder":
        $orderClause .= " ORDER BY `title` ASC";
        break;
}

$Eventquery = "SELECT * FROM `trabfinal-event` $whereClause $orderClause";

$warning = filter_input(INPUT_GET, 'w', FILTER_VALIDATE_BOOLEAN);
if($warning) {
        echo "<h4 class='warning'>Authentication required!</h4>";
}

$eventRS = mysql_query($Eventquery, $GLOBALS['ligacao']);
if ($eventRS && mysql_num_rows($eventRS) != 0) {
    $eventList = "";
    while ($result = mysql_fetch_array($eventRS)) {

        $authQuery = "SELECT * FROM `auth-basic` WHERE `id`=" . $result['creator'];
        $authRS = mysql_query($authQuery, $GLOBALS['ligacao']);
        $authResult = mysql_fetch_array($authRS);

        $commentsQuery = "SELECT * FROM `trabfinal-comment` 
                    INNER JOIN `trabfinal-event_comment` ON
                    `trabfinal-comment`.`idComment`= `trabfinal-event_comment`.`idComment` 
                    WHERE `idEvent`=" . $result['idEvent'];
        $commentRS = mysql_query($commentsQuery, $GLOBALS['ligacao']);
        ?>
<table class="eventBlock">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <a class="eventBlockTittle" <?php echo 'href="eventPage.php?idEvent=' . $result['idEvent'] . '">' . $result['title']; ?></a>
                        </tr>
                        <tr>
                            <td>Submitted <?php echo $result['pubDate'] . " by " . $authResult['name']; ?> </td>
                        </tr>
                        <tr>
                            <td><?php echo "Category: " . $result['idCategory'] . " | SubCategory: " . $result['idSubCategory']; ?></td>
                        </tr>
                        <tr>
                            <td>Comments <?php echo mysql_num_rows($commentRS); ?> </td>
                        </tr>
                        <?php
                        if ($role >= 2) {
                            echo "<tr><td>" .
                            "<a href='removeEvent.php?idEvent=" . $result['idEvent'] . "'>Remove</a>" .
                            " | " .
                            "<a href='formEditEvent.php?idEvent=" . $result['idEvent'] . "'>Edit</a>" .
                            "</td> </tr>";
                        }
                        ?>
                    </table>
                </td>
            </tr>
        </table>
        <?php
    }
} else {
    echo "No results were found.";
}
dbDisconnect();
