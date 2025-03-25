<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);
isRegistered($conn, $user_data["user_id"]);

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $warden_id = $user_data["user_id"];
    if (!empty($full_name) && !empty($date_of_birth) && !empty($phone_number) && !empty($address) && !empty($salary)) {
        $warden_query = "insert into Wardens (warden_id,full_name,date_of_birth,phone_number,address,monthly_salary) value ('$warden_id','$full_name','$date_of_birth','$phone_number','$address','$salary')";

        mysqli_query($conn, $warden_query);

        header("Location: ./dashboard.php");
        die;
    } else {
        echo "please insert some valid information";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

</head>

<body>
    <?php require_once "../util/navbar-warden.php" ?>
    <h1>welcome <?php echo htmlspecialchars($user_data["username"]) ?></h1>
    <p>to register as a warden please submit the following form</p>
    <form method="post">
        <label for="full_name">full legal name</label>
        <input type="text" name="full_name" id="full_name">
        <label for="date_of_birth">date of birth</label>
        <input type="date" name="date_of_birth" id="date_of_birth">
        <label for="phone_number">phone number</label>
        <input type="number" name="phone_number" id="phone_number">
        <label for="address">residental address</label>
        <input type="text" name="address" id="address">
        <label for="salary">monthly salary</label>
        <input type="number" name="salary" id="salary">
        <br>
        <button type="submit" name="submit">register</button>

    </form>

</body>

</html>