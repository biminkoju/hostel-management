<?php
session_start();
include "helper/dbcon.php";
include "helper/functions.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    if (!empty($email) && !empty($password) && !empty($account_type)) {
        // Query the database
        if ($account_type != 'admin') {
            $query = "SELECT * FROM Users WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $userdata = mysqli_fetch_assoc($result);

                // Check if password matches
                if ($password === $userdata['password']) {
                    // Check if account type matches
                    if ($account_type === $userdata['account_type']) {
                        echo "hallo everyone";
                        $_SESSION['user_id'] = $userdata['user_id'];
                        $_SESSION['account_type'] = $userdata['account_type'];

                        // Redirect based on account type
                        if ($account_type === 'resident') {
                            header("Location: ./resident/dashboard.php");
                            die;
                        }
                        if ($account_type === 'warden') {
                            header("Location: ./warden/dashboard.php");
                            die;
                        }
                        if ($account_type === 'admin') {
                            header("Location: ./admin.php");
                            die;
                        }

                    } else {
                        echo "Invalid account type.";
                    }
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "Invalid email or user does not exist.";
            }
        } else {
            header("Location: admin.php");
            die;
        }
    } else {
        echo "Please enter all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <?php require_once "./util/navbar-home.php" ?>

    <h1>login</h1>
    <div id="box">
        <form method="post">
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
            <input type="submit" value="Login">
            <br>


            <a href="./signup.php">click to sign up</a>
        </form>
    </div>
</body>

</html>