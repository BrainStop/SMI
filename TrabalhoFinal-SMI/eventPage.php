<?php
require_once( "../Lib/lib.php" );
require_once( "../Lib/db.php" );

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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <script type="text/javascript" src="./js/votes.js"></script>
        <title></title>
    </head>
    <body>
        <?php include 'navbar.php'; ?>

        <section class="content">
            <?php
            $configurations = getConfiguration();

            dbConnect(ConfigFile);

            mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

            $idEvent = filter_input(INPUT_GET, 'idEvent', FILTER_VALIDATE_INT);

            $Eventquery = "SELECT * "
                    . "FROM `trabfinal-event` "
                    . "WHERE `idEvent`=" . $idEvent . "";

            $eventRS = mysql_query($Eventquery, $GLOBALS['ligacao']);

            if ($eventRS) {
                $result = mysql_fetch_array($eventRS);

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
                            <img src="<?php echo "showFileThumb.php?id=" . $result['creator'] . "&type=profile"; ?>">
                        </td>
                        <td id="<?php echo $idEvent . '|Event' ?>">
                            <?php echo $result['votes']; ?> 
                        </td>
                        <td>
                            <button class="buttonDark" 
                                    name="commentLike" 
                                    type="button"
                                    value="<?php echo "id=$idEvent" ?>"
                                    onclick="upVoteEvent(this)">
                                Like
                            </button>
                            <br>
                            <button class="buttonDark" 
                                    name="commentDislike" 
                                    type="button"
                                    value="<?php echo "id=$idEvent" ?>"
                                    onclick="downVoteEvent(this)"
                                    >Dislike</button>
                        </td>
                        <td> 
                            <table class="eventBlock">
                                <tr>
                                    <td id="eventTitle"> <?php echo $result['title']; ?></td>
                                </tr>
                                <tr>
                                    <td>Submitted <?php echo $result['pubDate'] . " by " . $authResult['name']; ?> </td>
                                </tr>
                                <tr>
                                    <td>Comments <?php echo mysql_num_rows($commentRS); ?> </td>
                                </tr>
                            </table>
                        </td>
                    </tr> 
                    <tr>
                        <td class="description" colspan='4'> <?php echo $result['description'] ?> </td>
                    </tr>
                    <tr>
                        <td colspan='4'>
                            <img class="contentImgs" src='<?php echo "showFileThumb.php?id=$idEvent&type=event"; ?>'> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan='4'>
                            <form 
                                enctype="multipart/form-data"
                                action="processFormComment.php"
                                method="POST"
                                name="FormUpload">
                                <textarea 
                                    name="comment" 
                                    placeholder='Type comment here...' 
                                    cols="105" 
                                    rows="4"></textarea><br>
                                <input 
                                    type="hidden" 
                                    name="MAX_FILE_SIZE" 
                                    value="<?php echo $configurations['maxFileSize'] ?>">
                                <input 
                                    type="hidden" 
                                    name="idEvent" 
                                    value="<?php echo $result['idEvent'] ?>">
                                <input 
                                    class="buttonDark"
                                    type="file" 
                                    name="userFile" 
                                    size="64"><br>
                                <input
                                    class="buttonDark"
                                    type="submit"
                                    name="Submit"
                                    value="Add Comment!">
                            </form>
                        </td>
                    </tr>
                </table>

                <?php
            }

            $commentQuery = "SELECT * FROM `trabfinal-comment` 
                    INNER JOIN `trabfinal-event_comment` ON
                    `trabfinal-comment`.`idComment`= `trabfinal-event_comment`.`idComment` 
                    WHERE `idEvent`=$idEvent;";

            $commentRS = mysql_query($commentQuery, $GLOBALS['ligacao']);

            if ($commentRS) {
                while ($result = mysql_fetch_array($commentRS)) {

                    $idComment = $result['idComment'];

                    $authQuery = "SELECT * FROM `auth-basic` WHERE `id`=" . $result['creator'];
                    $authRS = mysql_query($authQuery, $GLOBALS['ligacao']);
                    $authResult = mysql_fetch_array($authRS);
                    ?>

                    <table class="eventBlock">
                        <tr>
                            <td>
                                <img src="<?php echo "showFileThumb.php?id=" . $result['creator'] . "&type=profile"; ?>">
                            </td>
                            <td> <?php echo $authResult['name']; ?> </td>
                            <td id="<?php echo $idComment . '|Comment' ?>">
                                <?php echo $result['votes']; ?>
                            </td>
                            <td>
                                <button class="buttonDark" 
                                        name="commentLike" 
                                        type="button"
                                        value="<?php echo "id=$idComment" ?>"
                                        onclick="upVoteComment(this)">
                                    Like
                                </button>
                                <br>
                                <button class="buttonDark" 
                                        name="commentDislike" 
                                        type="button"
                                        value="<?php echo "id=$idComment" ?>"
                                        onclick="downVoteComment(this)"
                                        >Dislike</button>
                            </td>
                            <td> <?php echo $result['dateComment']; ?></td>
                        </tr>
                        <tr>
                            <td class="description" colspan='5'> <?php echo $result['contents']; ?> </td>
                        </tr>
                        <tr>
                            <td colspan='5'><img class="imgSubComment" src="<?php echo "showFileThumb.php?id=$idComment&type=comment"; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan='5'>
                                <a href="<?php echo "removeComment.php?idComment=$idComment&idEvent=$idEvent"; ?>">Remove</a> |
                                <a href="<?php echo "FormEditComment.php?idComment=$idComment&idEvent=$idEvent"; ?>" >Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='5'>
                                <form 
                                    enctype="multipart/form-data"
                                    action="processFormSubComment.php"
                                    method="POST"
                                    name="FormUpload">
                                    <textarea 
                                        name="comment" 
                                        placeholder='Type comment here...' 
                                        cols="105" 
                                        rows="4"></textarea><br>
                                    <input
                                        type="hidden" 
                                        name="MAX_FILE_SIZE" 
                                        value="<?php echo $configurations['maxFileSize'] ?>">
                                    <input 
                                        type="hidden" 
                                        name="parentComment" 
                                        value="<?php echo $idComment ?>">
                                    <input 
                                        type="hidden" 
                                        name="idEvent" 
                                        value="<?php echo $result['idEvent'] ?>">
                                    <input 
                                        class="buttonDark"
                                        type="file" 
                                        name="userFile" 
                                        size="64"><br>
                                    <input 
                                        class="buttonDark"
                                        type="submit"
                                        name="Submit"
                                        value="Add Comment!">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='5' id="subsubcomment">
                                <?php
                                $subCmmentQuery = "SELECT * FROM `trabfinal-comment` "
                                        . "INNER JOIN `trabfinal-comment_comment` "
                                        . "ON `childComment`=`idComment` "
                                        . "WHERE `parentComment`=$idComment";

                                $subCommentRS = mysql_query($subCmmentQuery, $GLOBALS['ligacao']);
                                if ($subCommentRS) {
                                    while ($subResult = mysql_fetch_array($subCommentRS)) {

                                        $idSubComment = $subResult['childComment'];

                                        $subAuthQuery = "SELECT * FROM `auth-basic` WHERE `id`=" . $subResult['creator'];
                                        $subAuthRS = mysql_query($subAuthQuery, $GLOBALS['ligacao']);
                                        $subAuthResult = mysql_fetch_array($subAuthRS);
                                        ?>

                                        <table class="eventBlock">
                                            <td>
                                                <img src="<?php echo "showFileThumb.php?id=" . $subResult['creator'] . "&type=profile"; ?>">
                                            </td>
                                            <td> <?php echo $subAuthResult['name']; ?> </td>
                                            <td id="<?php echo $idSubComment . '|Comment' ?>">
                                                <?php echo $subResult['votes']; ?>
                                            </td>
                                            <td>
                                                <button class="buttonDark" 
                                                        name="commentLike" 
                                                        type="button"
                                                        value="<?php echo "id=$idSubComment" ?>"
                                                        onclick="upVoteComment(this)">
                                                    Like
                                                </button>
                                                <br>
                                                <button class="buttonDark" 
                                                        name="commentDislike" 
                                                        type="button"
                                                        value="<?php echo "id=$idSubComment" ?>"
                                                        onclick="downVoteComment(this)"
                                                        >Dislike</button>
                                            </td>
                                            <td> <?php echo $subResult['dateComment']; ?></td>
                                </tr>
                                <tr>
                                    <td class="description" colspan='5'> <?php echo $subResult['contents']; ?> </td>
                                </tr>
                                <tr>
                                    <td colspan='5'><img class="imgSubSubComment" src=<?php echo "showFileThumb.php?id=$idSubComment&type=subcomment"; ?>></td>
                                </tr>
                                <tr>
                                    <td colspan='5'>
                                        <a href="<?php echo "removeSubComment.php?idSubComment=$idSubComment&idEvent=$idEvent"; ?>">Remove</a> | 
                                        <a href="<?php echo "FormEditSubComment.php?idComment=$idSubComment&idEvent=$idEvent"; ?>" >Edit</a>
                                    </td>
                                </tr>
                            </table>
                            <?php
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>

        <?php
    }
    dbDisconnect();
}
?>
</section>
</body>
</html>
