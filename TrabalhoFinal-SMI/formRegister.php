<?php
require './validationregex.php';
require_once( "../Lib/lib.php" );

$configurations = getConfiguration();

if (isset($_GET)) {
    $usernameErr = filter_input(INPUT_GET, 'usernameErr',  FILTER_VALIDATE_BOOLEAN);
    $passwordErr = filter_input(INPUT_GET, 'passwordErr',  FILTER_VALIDATE_BOOLEAN);
    $emailErr    = filter_input(INPUT_GET, 'emailErr',     FILTER_VALIDATE_BOOLEAN);
    $captchaErr  = filter_input(INPUT_GET, 'captchaErr',   FILTER_VALIDATE_BOOLEAN);
    $userUsed    = filter_input(INPUT_GET, 'usernameUsed', FILTER_VALIDATE_BOOLEAN);
    $emailUsed   = filter_input(INPUT_GET, 'emailUsed',    FILTER_VALIDATE_BOOLEAN);
    $imageErr    = filter_input(INPUT_GET, 'imageErr',     FILTER_VALIDATE_BOOLEAN);

    $username = filter_input(INPUT_GET, 'usernameVal', FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => $usernameRegex)));

    $email = filter_input(INPUT_GET, 'emailVal', FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => $emailRegex)));
}
?>
<script type="text/javascript" src="js/registerForm.js"></script>
<form 
    enctype="multipart/form-data"
    name="form" 
    action="processFormRegister.php" 
    method="POST" 
    onsubmit="return validateForm()">
<?php
if ($usernameErr) {
    echo "<span class='warning'>Invalid Username.</span><br>";
} elseif ($userUsed) {
    echo "<span class='warning'>Username is already in use.</span><br>";
}
?>
    User Name: <input type="text"
                      name="username"
        <?php
        echo "value=$username";
        ?>
                      ><br>
                      <?php
                      if ($passwordErr) {
                          echo "<span class='warning'>Invalid Password.</span><br>";
                      }
                      ?>
    Password: <input type="password" name="password"><br>
    <?php
    if ($emailErr) {
        echo "<span class='warning'>Invalid Email.</span><br>";
    } elseif ($emailUsed) {
        echo "<span class='warning'>Email is already in use.</span><br>";
    }
    ?>
    Email: <input type="email"
                  name="email"
                  <?php echo "value='$email'" ?> ><br>
    <?php
    if ($imageErr) {
        echo "<span class='warning'>Image needed!</span><br>";
    }
    ?>
    <input 
        type="hidden" 
        name="MAX_FILE_SIZE" 
        value="<?php echo $configurations['maxFileSize'] ?>">
    <input 
        type="file" 
        name="userFile" 
        size="64"><br>
        <?php
        if ($captchaErr) {
            echo "<span class='warning'>Invalid Captcha.</span><br>";
        }
        ?>
    <img src="captchaImage.php"/><br>
    <input type="text" name="captcha" id="captcha">
    <button class="buttonDark" type="submit" value="Submit">Submit</button>
</form>
