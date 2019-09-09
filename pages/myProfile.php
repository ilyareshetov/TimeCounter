<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$title = 'My Profile';

require_once 'header.php';
$get = $db->query("SELECT * FROM users WHERE username = '{$_COOKIE['user']}'");
$res = $get->fetch_assoc();
?>
<table>
    <tr>
        <td>
            <img src="<?=$res['picture'] ?>" alt="picture" width="300px" height="200px">
        </td>
        <td>
            <p>Your username: <?=$res['username'] ?></p>
            <p>Your email: <?=$res['email'] ?></p>
            <p>Current password: <?=$res['password'] ?></p>
            <p>Collected points: <?=$res['points'] ?></p>
        </td>
    </tr>
</table>

<?php

require_once 'footer.php';