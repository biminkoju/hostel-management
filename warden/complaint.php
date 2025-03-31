<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$warden_info_data = getWardenInfo($conn, $user_data["user_id"]);

$warden_id = $warden_info_data["warden_id"];
$id = isset($_GET['id']) ? $_GET['id'] : 0;


$complaint = getComplaint($conn, $id);
$hostel_id = $complaint['hostel_id'];

$resident = getResidentInfo($conn, $complaint['resident_id']);
$hostel = getHostelInfoWarden($conn, $hostel_id);

$hostel_warden_id = $hostel['warden_id'];

if ($warden_id != $hostel_warden_id) {
    // Redirect if the warden does not manage this hostel
    header("Location: ./hostels.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complaint</title>
</head>

<body>
    <?php require_once "../util/navbar-warden.php" ?>
    <p>this is the complaint made by the resident of room number <?php echo $resident["room_number"] ?> </p>
    <p>complaint id: <?php echo $complaint["complaint_id"] ?></p>
    <p>complaint made on: <?php echo $complaint["date_of_complaint"] ?></p>
    <p>complaint: <?php echo $complaint["description"] ?></p>
    <p>status: <?php echo $complaint["status"] ?></p>

</body>

</html>