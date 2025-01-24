<?php

function checklogin($con)
{

    if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM Users where user_id = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    } else {

        //redirect to login
        header("Location: ../login.php");
        die;
    }
}

function rightRedirect($user_data)
{
    if ($user_data['account_type'] === 'warden') {
        if ($_SERVER['REQUEST_URI'] !== '/hostel-management/warden/dashboard.php') {

            header("Location: ../warden/dashboard.php");
            die;
        }
    }
    if ($user_data['account_type'] === 'resident') {
        if ($_SERVER['REQUEST_URI'] !== '/hostel-management/resident/dashboard.php') {
            header("Location: ../resident/dashboard.php");
            die;
        }
    }
    if ($user_data['account_type'] === 'admin') {
        if ($_SERVER['REQUEST_URI'] !== '/hostel-management/admin.php') {
            header("Location: ../admin.php");
            die;
        }
    }
}
?>