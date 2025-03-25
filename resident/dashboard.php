<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");
include("../helper/sitestatements.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$resident_info_data = getResidentInfo($conn, $user_data['user_id']);
$hostel_info_data = getHostelInfo($conn, $resident_info_data['hostel_id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">

</head>

<body>
    <script>
        <?php ?>
    </script>
    <?php require_once "../util/navbar-resident.php" ?>

    <?php
    $hour = intval("<script>document.write(new Date().getHours())</script>");
    if ($hour < 12) {
        echo "<h1>Good Morning, " . htmlspecialchars($user_data['username']) . "!</h1>";
    } elseif ($hour < 18) {
        echo "<h1>Good Afternoon, " . htmlspecialchars($user_data['username']) . "!</h1>";
    } else {
        echo "<h1>Good Evening, " . htmlspecialchars($user_data['username']) . "!</h1>";
    }

    if ($hostel_info_data['hostel_name']) {
        echo "<p>You're in the " . htmlspecialchars($hostel_info_data['hostel_name']) . "</p>";
    } else {
        echo "<p>you have not been assigned a hostel</p>";
    }
    if ($resident_info_data['status'] === 'active') {
        echo "<p>you are currently staying in the hostel</p>";
        echo "<p>your room number is " . htmlspecialchars($resident_info_data['room_number']) . "</p>";
    } else if ($resident_info_data['status'] === 'inactive' || $resident_info_data['status'] === null) {
        echo "<p>you are currently not staying in the hostel</p>";
    }

    ?>
</body>

</html>