<?php
function checklogin($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = mysqli_real_escape_string($con, $_SESSION['user_id']);
        $query = "SELECT * FROM Users WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

        // User ID in session but not found in database
        // Clear invalid session and redirect
        session_unset();
        session_destroy();
        header("Location: ../login.php");
        die;
    } else {
        // No user ID in session
        header("Location: ../login.php");
        die;
    }
}

function rightRedirect($user_data)
{
    // Define the base path for easier maintenance
    $base_path = "/hostel-management";
    $current_uri = $_SERVER['REQUEST_URI'];

    switch ($user_data['account_type']) {
        case 'warden':
            if (strpos($current_uri, "$base_path/warden/") === false) {
                header("Location: ../warden/dashboard.php");
                die;
            }
            break;

        case 'resident':
            if (strpos($current_uri, "$base_path/resident/") === false) {
                header("Location: ../resident/dashboard.php");
                die;
            }
            break;

        case 'admin':
            // Fixed: Redirect if NOT in admin area
            if (strpos($current_uri, "$base_path/admin.php") === false) {
                header("Location: ../admin.php");
                die;
            }
            break;

        default:
            // Handle unknown account types
            // You might want to log this situation or redirect to a default page
            header("Location: ../login.php");
            die;
    }
}

function getResidentInfo($con, $resident_id)
{
    $resident_id = mysqli_real_escape_string($con, $resident_id);
    $resident_info_query = "SELECT * FROM Residents WHERE resident_id='$resident_id' LIMIT 1;";
    $resident_info_result = mysqli_query($con, $resident_info_query);

    if ($resident_info_result && mysqli_num_rows($resident_info_result) > 0) {
        return mysqli_fetch_assoc($resident_info_result);
    } else {
        echo "Error: " . $resident_info_query . "<br>" . mysqli_error($con);
        return [];
    }
}

function getHostelInfo($con, $hostel_id)
{
    $hostel_id = mysqli_real_escape_string($con, $hostel_id);
    $hostel_info_query = "SELECT * FROM Hostels WHERE hostel_id='$hostel_id' LIMIT 1;";
    $hostel_info_result = mysqli_query($con, $hostel_info_query);

    if ($hostel_info_result && mysqli_num_rows($hostel_info_result) > 0) {
        return mysqli_fetch_assoc($hostel_info_result);
    } else {
        echo "Error: " . $hostel_info_query . "<br>" . mysqli_error($con);
        return ['hostel_name' => 'Unknown Hostel'];
    }
}

function getWardenInfo($con, $warden_id)
{
    $warden_id = mysqli_real_escape_string($con, $warden_id);
    $warden_info_query = "SELECT * FROM Wardens WHERE warden_id='$warden_id' LIMIT 1;";
    $warden_info_result = mysqli_query($con, $warden_info_query);

    if ($warden_info_result && mysqli_num_rows($warden_info_result) > 0) {
        return mysqli_fetch_assoc($warden_info_result);
    } else {
        echo "Error: " . $warden_info_query . "<br>" . mysqli_error($con);
        return [];
    }
}

function getHostels($con, $warden_id)
{

    $hostels_query = "SELECT * FROM Hostels WHERE warden_id='$warden_id';";
    $hostels_result = mysqli_query($con, $hostels_query);

    if ($hostels_result && mysqli_num_rows($hostels_result) > 0) {
        return mysqli_fetch_all($hostels_result, MYSQLI_ASSOC);
    } else {
        echo "Error: " . $hostels_query . "<br>" . mysqli_error($con);
        return [];
    }
}