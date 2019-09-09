<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Comments';

if ($_POST['submit']) {
    $db->query("INSERT INTO comments (username, title, description) VALUES ('{$_COOKIE['user']}', '{$_POST['title']}', '{$_POST['description']}');");
    header( 'Refresh: 0; url=comments.php' );
}
elseif ($_POST['delete']) {
    $db->query("DELETE FROM comments WHERE id = '{$_POST['id']}'");
    header( 'Refresh: 0; url=comments.php' );
}
else {
    require_once 'header.php';
    ?>
    <div class = "formBlock" style="padding-top: 0px;">
        <h2>Create new comment</h2>
        <form method="post">
            <input type="text" name="title" placeholder="Write title"><br>
            <textarea name="description" placeholder="Write message"></textarea><br>

            <input type="submit" name="submit" value="create">
        </form>
    </div>
    <?php
    $get = $db->query("SELECT * FROM comments ORDER BY date DESC;");

    while ($res = $get->fetch_assoc()) {
        ?>
        <div class = "formBlock" style="padding-top: 5px;">
            <form method="post">
                <h3><?=$res['title'] ?></h3>
                <p><?=$res['description'] ?></p>
                <p>Date: <?=$res['date'] ?></p>
                <p>User: <?=$res['username'] ?></p>
                <?php
                    if ($_COOKIE['user'] == $res['username']) {
                        print('<input type="hidden" name="id" value="'.$res['id'].'">');
                        print('<input type="submit" name="delete" value="delete">');
                    }
                ?>
            </form>
        </div>
        <?php
    }
}

require_once 'footer.php';