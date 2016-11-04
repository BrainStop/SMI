<?php
require_once( "../Lib/db.php" );
require_once( "../Lib/lib.php" );

$configurations = getConfiguration();

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

dbConnect(ConfigFile);
mysql_select_db($GLOBALS['configDataBase']->db, $GLOBALS['ligacao']);

$queryUser = "SELECT * FROM `auth-basic`" .
        "INNER JOIN `trabfinal-user_media` " .
        "ON `idUser`=`id`" .
        "WHERE `id`=" . $_SESSION['id'];

$resultUser = mysql_query($queryUser);
$rowUser = mysql_fetch_array($resultUser);

dbDisconnect();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <link
        <script type="text/javascript" src="./js/formAddEvent.js"></script>
    </head>
    <body>
        <?php include './navbar.php' ?> 
        <section class="content">
            <script type="text/javascript" src="./js/UpdateUserForm.js"></script>
            <form
                enctype="multipart/form-data"
                action="processFormUpdateUser.php" 
                method="POST"
                name="form"
                onsubmit="return validateFormUpdateUser()">
                <table
                    <tr>
                        <th>Value</th>
                        <th>Old</th>
                        <th>New</th>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?php echo $rowUser['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $rowUser['email']; ?></td>
                        <td><input type="email" name="email"></td>
                    </tr>
                    <tr>
                        <td>Repeat Email</td>
                        <td></td>
                        <td><input type="email" name="repEmail"></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>
                            <img src="showFileThumb.php?
                                 id=<?php echo $rowUser['id']; ?>&amp;type=profile">
                        </td>
                        <td>
                            <input 
                                type="hidden" 
                                name="MAX_FILE_SIZE" 
                                value="<?php echo $configurations['maxFileSize'] ?>">
                            <input 
                                type="file" 
                                name="userFile" 
                                size="64"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Old Password</td>
                        <td></td>
                        <td><input type="password" name="oldPassword"></td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td></td>
                        <td><input type="password" name="newPassword"></td>
                    </tr>
                    <tr>
                        <td>Repeat Password</td>
                        <td></td>
                        <td><input type="password" name="repNewPassword"></td>
                    </tr>
                    <tr>
                        <td><button class="buttonDark" type="submit" value="Submit">Submit</button></td>
                    </tr>
                </table>
            </form>
        </section>
    </body>
</html>
