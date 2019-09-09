<?php
require_once 'connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web application</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <ul id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="pages/rank.php">Top-5 users</a></li>
        <?php
            if (isset($_COOKIE['user'])) {
                print '<li><a href="pages/myProfile.php">My Profile</a></li>';
                print '<li><a href="pages/activity.php">Activity</a></li>';
                print '<li><a href="pages/statistic.php">Statistical</a></li>';
                print '<li><a href="pages/comments.php">Comments</a></li>';
                print '<li><a href="pages/logout.php">Sign out</a></li>';
            }
            else {
                print '<li><a href="pages/login.php">Sign In</a></li>';
                print '<li><a href="pages/register.php">Sign up</a></li>';
            }
        ?>

    </ul>
</header>
<div class="clear"></div>
<div style="font-size: 20px">
<div class="formBlock" style="padding-top: 0px;">
    <h2>What is Gamification and Why Use It in Teaching?</h2>
    <p>The word “gamification” had made its way through both corporate culture and the education world, but what exactly is gamification and does it really work?</p>
    <p>In general, the “Gamification” teaching strategy means the taking of principals from games (often video games, but not always) and incorporating them into … well … whatever you’re trying to gamify.  Marketers have been circulating this term for years, and brands continue to try to formulate the perfect balance of gamification in their outreach schemes.</p>
</div>
    <ul>
        <li><b>Experience</b> – This is mechanic is used by the vast majority of game makers now because it provides real-time feedback and progress tracking for players.</li>
        <li><b>Leveling Up</b> – Tied closely to experience (above), when a player accumulates enough experience, a character often “levels up,” providing a metric for progress that doesn’t feel like a grade.</li>
        <li><b>Rewarding Exploration</b> – Think like a video game developer – if you went to all the trouble of creating an entire world for people to play in, wouldn’t you want them to explore? Games often reward players for exploring – how can you do the same in your classroom?</li>
        <li><b>Unlocking</b> – What makes players want to gain experience, level up and explore? Unlocking new things! In games, that means new abilities, areas, items, etc. When players reach a certain level, they can do more, use more and explore more.</li>
        <li><b>Competition</b> – Now this is a hot-button issue when we’re thinking about school generally, but something about competitiveness in gaming only pushes players to continue to do better. Rather than “losing” players receiving negative feedback, the “winning” players receive some type of (low-value) reward. The reward is simply a token for winning (sometimes as simple as a badge or a title) and doesn’t have significant impact on the experience of the players.</li>
        <li><b>Something New</b> – Gamers and developers alike will tell you that once a game is “finished” – once all of the cool items, abilities, levels, etc. have been unlocked - players begin to lose interest. That’s why today’s game developers constantly update games with new items, unlocks, and so on. When thinking about this mechanic in a classroom context, it’s important to make sure there is a reason for students to continue playing the “game.”</li>
    </ul>
</div>

<?php


require_once 'pages/footer.php';