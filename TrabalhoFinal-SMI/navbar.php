<header>
    <h1 class="title">Dota Dungeon</h1>
    <img class="logo" src="./assets/dota2_logo.png">
    <br>
    <h6 class="subTitle">Gonçalo Oliveira</h6>
</header>
<nav>
    <a href="index.php">Home</a>
    <?php
    if ( !isset( $_SESSION ) ) {
        session_start();
        if ( !isset( $_SESSION['username'] ) ) {
            $_SESSION['role'] = -1;
        }
    }
    $role = $_SESSION['role'];
    if ( $role >= 2 ) {
        echo '<a href="formAddEvent.php">New Event</a>';
    }
    if ( $role == 3 ) {
        echo '<a href="userPermissions.php">Users Permissions</a>';
    }
    if ( $role >= 1 ) {
        echo '<a href="subscriptionList.php">Subscriptions</a>';
    }
    if ( $role >= 0 ) {
        echo '<a href="formUpdateUser.php">Edit Profile</a>';
    }
    ?>
</nav>
<aside>
    <?php
    $register = filter_input(INPUT_GET, 'r', FILTER_VALIDATE_BOOLEAN);
    /* Check if user is already logged in */
    if ( !isset( $_SESSION ) ) {
        session_start();
    }
    if ( isset( $_SESSION['username'] ) ) {
        include './userInfo.php';
    } else if($register) {
        include './formRegister.php';
    } else {
        include './formLogin.php';
    }
    ?>
</aside>