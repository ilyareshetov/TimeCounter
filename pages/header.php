<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js" type="text/javascript"></script>
</head>
<body>
<header>
    <ul class="float" id="menu">
        <li><a href="../index.php">Home</a></li>
        <li><a href="rank.php">Top-5 users</a></li>
        <?php
            if (isset($_COOKIE['user'])) {
                print '<li><a href="myProfile.php">My Profile</a></li>';
                print '<li><a href="activity.php">Activity</a></li>';
                print '<li><a href="statistic.php">Statistical</a></li>';
                print '<li><a href="comments.php">Comments</a></li>';
                print '<li><a href="logout.php">Sign out</a></li>';
            } else {
                print '<li><a href="login.php">Sign In</a></li>';
                print '<li><a href="register.php">Sign Up</a></li>';
            }
        ?>
    </ul>
</header>
<div class="clear"></div>