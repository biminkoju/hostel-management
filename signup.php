<?php
session_start();
include "helper/dbcon.php";
include "helper/functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //if something was posted
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    if (!empty($email) && !empty($password) && !empty($username) && !empty($account_type)) {
        // save to database
        if ($account_type != 'admin') {
            $query = "INSERT into Users (username, email, password,account_type) value ('$username','$email','$password','$account_type')";
            mysqli_query($conn, $query);
            header("Location: login.php");
            die;
        } else {
            header("Location: admin.php");
            die;
        }
    } else {
        echo "please enter some valid information";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
</head>

<body>
    <?php require_once "./util/navbar-home.php" ?>
    <h1>sign up</h1>
    <div id="box">
        <form method="post">
            username
            <input type="text" name="username">
            email
            <input type="email" name="email">
            password
            <input type="password" name="password">
            <label for="account_type">Choose your account type</label>
            <select id="account_type" name="account_type">
                <option value="resident">resident</option>
                <option value="warden">warden</option>
                <option value="admin">admin</option>
            </select>
            <br>
            <input type="submit" value="Sign-up">
            <br>
            <a href="./login.php">click to login</a>
        </form>
    </div>
</body>

</html>