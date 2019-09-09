<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Activity page';

if (isset($_POST['submit'])) {
    $db->query("INSERT INTO tasks (title, username) VALUES ('{$_POST['taskName']}', '{$_COOKIE['user']}');");
    $id = mysqli_insert_id($db);
    //Redirect to start timer
    SetCookie('title', "{$_POST['taskName']}", 0, '/');
    SetCookie('id', "{$id}", 0, '/');
    header('Refresh: 0; url=activity.php');
} else if (isset($_POST['reset'])) {
        $p = (float)$_POST['points'];
        $i = (int)$_COOKIE['id'];
        $db->query("UPDATE tasks SET points = {$p}, complete = 1 WHERE id = {$i};");
        $res = $db->query("SELECT points FROM users WHERE username = '{$_COOKIE['user']}';");
        $get = $res->fetch_array();
        $total = $p + $get['points'];
        $db->query("UPDATE users SET points = {$total} WHERE username = '{$_COOKIE['user']}';");
        unset($_COOKIE['id']);
        unset($_COOKIE['title']);
        SetCookie('id', null, -1, '/');
        SetCookie('title', null, -1, '/');
        header('Refresh: 0; url=activity.php');
}
else {
    require_once 'header.php';
    if ($_COOKIE['id']) {
        ?>
        <h2>Now you are working on: <?=$_COOKIE['title'] ?></h2>

        <div class="timer">
            <span id="minutes"></span>
            <span id="delimiter">:</span>
            <span id="seconds"></span>
        </div>

        <form method="post">
            <input type="button" name="stop" value="Stop" onclick="stopButton();" id="stop">
            <input type="button" name="reset" value="Reset" onclick="resetButton();">
        </form>
        <?php
    }
    else {
        ?>
        <form method="post" class="formBlock">
            <p>Enter a title for the task: </p>
            <input type="text" name="taskName"><br>
            <input type="submit" value="Create Task and Starts" name="submit">
        </form>
        <?php
    }
}

require_once 'footer.php';

