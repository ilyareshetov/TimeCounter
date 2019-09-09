<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Top-5 users';
require_once 'header.php';

$get = $db->query("SELECT * FROM users ORDER BY points DESC LIMIT 5");

?>
<div class = "formBlock">
    <h1>Top-5 users</h1>
    <table>
        <?php while ($res = $get->fetch_assoc()): ?>
            <tr>
                <td><?=$res['username']?></td>
                <td><?=$res['points'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php


require_once 'footer.php';