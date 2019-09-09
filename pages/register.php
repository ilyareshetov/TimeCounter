<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Register';


if (isset($_POST['submit'])) {
    if ($_POST['password'] == $_POST['passwordRepeat']) {
        $get = $db->query("SELECT username FROM users WHERE username = '{$_POST['login']}'");
        //var_dump($get->fetch_array());
        if ($get->fetch_array() == null) {
            $uploaddir = '../images/';
            $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

            $db->query("INSERT INTO users (username, password, email, picture) VALUES ('{$_POST['login']}', '{$_POST['password']}', '{$_POST['email']}', '{$uploadfile}');");
            SetCookie('user', "{$_POST['login']}", 0, '/');
            header( 'Refresh: 3; url=../index.php' );
            print 'Account created successfully, you will be redirected in 3 seconds.';
        }
        else {
            header( 'Refresh: 2; url=register.php' );
            print '<p>User with this login already created!</p>';
        }
    }
    else {
        header( 'Refresh: 2; url=register.php' );
        print '<p>The password do not match!</p>';
    }


}
else {
    require_once 'header.php';
?>
<div class = "formBlock">
    <h1>Registration</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="login" placeholder="Write your username"><br>
        <input type="password" name="password" placeholder="Write password"><br>
        <input type="password" name="passwordRepeat" placeholder="Confirm password"><br>
        <input type="email" name="email" placeholder="Write your email address"><br>
        <input type="file" name="picture"><br>

        <input type="submit" name="submit" value="Register account">
    </form>
</div>
<?php
}



require_once 'footer.php';
