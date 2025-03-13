<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$warden_info_data = getWardenInfo($conn, $user_data['user_id']);

$hostels = getHostels($conn, $warden_info_data['warden_id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hostels</title>
    <style>
        table {
            counter-reset: tableCount;
        }

        .counterCell:before {
            content: counter(tableCount);
            counter-increment: tableCount;
        }
    </style>
</head>

<body>
    <?php require_once "../util/navbar-warden.php" ?>
    <p>the list of hostels you are a warden of:</p>
    <table>
        <tr>
            <th>S.N</th>
            <th>hostel name</th>
            <th>hostel location</th>
            <th>hostel capacity</th>
        </tr>
        <?php foreach ($hostels as $hostel) { ?>
            <tr>
                <td class="counterCell"></td>
                <td><?php echo $hostel['hostel_name'] ?></td>
                <td><?php echo $hostel['address'] ?></td>
                <td><?php echo $hostel['capacity'] ?></td>
            </tr>
        <?php } ?>
    </table>


</body>

</html>