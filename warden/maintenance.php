<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$warden_info_data = getWardenInfo($conn, $user_data["user_id"]);

$warden_id = $warden_info_data["warden_id"];
$id = isset($_GET['id']) ? $_GET['id'] : 0;


$maintenance = getMaintenace($conn, $id);
$hostel_id = $maintenance['hostel_id'];

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
    <p>this is the maintenance request made by a resident of your hostel </p>
    <p>request id: <?php echo $maintenance["maintanance_id"] ?></p>
    <p>request made on: <?php echo $maintenance["date_of_payment"] ?></p>
    <p>amount required for maintenace to be done: <? echo $maintenance["amount"] ?></p>
    <p>request: <?php echo $maintenance["description"] ?></p>
    <p>status: <?php echo $maintenance["status"] ?></p>

</body>

</html>