<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Statistical';

require_once 'header.php';

print('<h2 class="formBlock" style="padding-top: 0;">Daily statistics</h2>');

$get = $db->query("SELECT * FROM tasks WHERE username = '{$_COOKIE['user']}' ORDER BY time DESC;");

$Mon = $Tue = $Wed = $Thu = $Fri = $Sat = $Sun = [];

while ($res = $get->fetch_assoc()) {
    switch (date('N', strtotime($res['time']))) {
        case '1':
            $Mon[$res['id']] = ['title' => $res['title'], 'time' => $res['time'], 'points' => $res['points']];
            break;
        case '2':
            $Tue[$res['id']] = ['title' => $res['title'], 'time' => $res['time'], 'points' => $res['points']];
            break;
        case '3':
            $Wed[$res['id']] = ['title' => $res['title'], 'time' => $res['time'], 'points' => $res['points']];
            break;
        case '4':
            $Thu[$res['id']] = ['title' => $res['title'], 'time' => $res['time'], 'points' => $res['points']];
            break;
        case '5':
            $Fri[$res['id']] = ['title' => $res['title'], 'time' => $res['time'], 'points' => $res['points']];
            break;
        case '6':
            $Sat[$res['id']] = ['title' => $res['title'], 'time' => $res['time'], 'points' => $res['points']];
            break;
        case '7':
            $Sun[$res['id']] = ['title' => $res['title'], 'time' => $res['time'], 'points' => $res['points']];
            break;
        default:
            break;
    }
}

function printDay($day, $dayArray) {
    foreach ($dayArray as $task) {
        ?>
        <tr>
            <td><?= $day ?></td>
            <td><?= $task['title'] ?></td>
            <td><?= $task['time'] ?></td>
            <td><?= $task['points'] ?></td>
        </tr>
        <?php
    }
}

?>
<table>
    <tr>
        <th>Day</th>
        <th>Title</th>
        <th>Start time</th>
        <th>Points</th>
    </tr>
<?php
if ($Mon) printDay('Monday', $Mon);
if ($Tue) printDay('Tuesday', $Tue);
if ($Wed) printDay('Wednesday', $Wed);
if ($Thu) printDay('Thursday', $Thu);
if ($Fri) printDay('Friday', $Fri);
if ($Sat) printDay('Saturday', $Sat);
if ($Sun) printDay('Sunday', $Sun);
print('</table>');


require_once 'footer.php';
