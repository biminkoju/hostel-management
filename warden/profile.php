<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$warden_info_data = getWardenInfo($conn, $user_data["user_id"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>

<body>
    <?php require_once "../util/navbar-warden.php" ?>
    <h1>profile</h1>
    <h3>name: <?php echo $warden_info_data["full_name"] ?></h3>
    <h3>date of birth: <?php echo $warden_info_data["date_of_birth"] ?></h3>
    <h3>email: <?php echo $user_data["email"] ?></h>
        <p>bio: <?php echo $user_data["bio"] ?></p>
        <p>phone: <?php echo $warden_info_data["phone_number"] ?></p>
        <p>address: <?php echo $warden_info_data["address"] ?></p>
        <p>salary: <?php echo $warden_info_data["monthly_salary"] ?></p>


</body>

</html>