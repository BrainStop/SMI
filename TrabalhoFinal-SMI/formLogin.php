<?php
$username = filter_input(INPUT_GET, 'username');
$remember_me = filter_input(INPUT_GET, 'remember_me', FILTER_VALIDATE_BOOLEAN);
$error = filter_input(INPUT_GET, 'error', FILTER_VALIDATE_BOOLEAN);
?>
<script type="text/javascript" src="./js/loginForm.js"></script>
<form name="form" method="POST" onsubmit="return validateFromLogin()">
    <?php
    if ($error) {
        echo '<span class="warning">Username/password are incorrect or'
        . ' acount needs to be autenticated.</span><br>';
    }
    ?>
    <input type="text"
           name="username"
           placeholder="Username"
           <?php
           if ($username) {
               echo "value=$username";
           }
           ?>
           />
    <input type="password" name="password" placeholder="Password"/><br>
    Remember me: 
    <input type="checkbox"
           name="remember_me"
           <?php
           if ($remember_me) {
               echo 'checked';
           }
           ?>/>    
    <a href="passRecovery.php">Forgot your password?</a><br>
    <input type="submit"
           name="login"
           value="Login"
           onclick="actionLogin()"/>
    <input type="submit"
           name="register"
           value="Register"
           onclick="actionRegister()"/>
</form>

