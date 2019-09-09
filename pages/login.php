<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Sign In';

if (isset($_POST['submit'])) {
    $get = $db->query("SELECT username FROM users WHERE username = '{$_POST['login']}' AND password = '{$_POST['password']}'");
    if ($get->fetch_assoc() != null) {
        SetCookie('user', "{$_POST['login']}", 0, '/');
        header( 'Refresh: 3; url=../index.php' );
        print 'The login is successful, you will be redirected in 3 seconds.';
    }
    else {
       header('Refresh: 4; url=login.php');
       print 'Wrong login or password, please write correct them.';
    }

}
else {
    require_once 'header.php';
    ?>
    <div class = "formBlock">
       <h1>Sign In</h1>
        <form method="post">
            <input type="text" name="login" placeholder="Write your username"><br>
            <input type="password" name="password" placeholder="Write password"><br>

            <input type="submit" name="submit" value="login">
        </form>
    </div>
    <?php
}

require_once 'footer.php';