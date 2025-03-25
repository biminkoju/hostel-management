<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$warden_info_data = getWardenInfo($conn, $user_data["user_id"]);

$warden_id = $warden_info_data["warden_id"];
// Get the ID from the URL (e.g., example.com/hostel.php?id=1) 
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Get the hostel information
$hostel = getHostelInfoWarden($conn, $id);

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
    <title>hostel dashboard</title>
</head>

<body>
    <?php require_once "../util/navbar-warden.php" ?>
    <h1>this is the <?php echo $hostel["hostel_name"] ?></h1>

</body>

</html>