<?php
session_start();
include("../../helper/dbcon.php");
include("../../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);
$warden_data = getWardenInfo($conn, $user_data['user_id']);
$warden_id = $warden_data['warden_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hostel_name = htmlspecialchars(trim($_POST['hostel_name']));
    $hostel_address = htmlspecialchars(trim($_POST['hostel_address']));
    $hostel_capacity = (int) $_POST['hostel_capacity'];
    $hostel_owner = htmlspecialchars(trim($_POST['hostel_owner'])) ?? "";
    $hostel_amenities = htmlspecialchars(trim($_POST['hostel_amenities']));
    $hostel_description = htmlspecialchars(trim($_POST['hostel_description']));

    if (!empty($hostel_name) && !empty($hostel_address) && !empty($hostel_capacity) && !empty($hostel_owner) && !empty($hostel_amenities) && !empty($hostel_description)) {
        $stmt = $conn->prepare("INSERT INTO Hostels (hostel_name, hostel_address, hostel_owner, hostel_capacity, amenities, description, warden_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $hostel_name, $hostel_address, $hostel_owner, $hostel_capacity, $hostel_amenities, $hostel_description, $warden_id);

        if ($stmt->execute()) {
            header("Location: ../hostels.php");
            error_log("New hostel created successfully");
            exit;
        } else {
            error_log("Query error: " . $stmt->error);
            echo "An error occurred. Please try again.";
        }
        $stmt->close();
    } else {
        echo "Please enter valid information.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create new hostel</title>

</head>

<body>
    <?php require_once "../../util/navbar-warden.php" ?>
    <h2>create a new hostel</h2>
    <p>please fill in the details below to create a new hostel</p>
    <br>
    <form method="post">
        <label for="hostel_name">hostel name</label>
        <input type="text" name="hostel_name" id="hostel_name" required>
        <label for="hostel_address">hostel address</label>
        <input type="text" name="hostel_address" id="hostel_address" required>
        <label for="hostel_capacity">hostel capacity</label>
        <input type="number" name="hostel_capacity" id="hostel_capacity" required>
        <label for="hostel_owner">hostel owner</label>
        <input type="text" name="hostel_owner" id="hostel_owner" required>
        <label for="hostel_amenities">hostel amenities</label>
        <input type="text" name="hostel_amenities" id="hostel_amenities" required>
        <label for="hostel_description">hostel description</label>
        <textarea type="text" name="hostel_description" id="hostel_description" required></textarea>
        <br>
        <input type="submit" name="submit" value="create hostel">
    </form>


</body>

</html>