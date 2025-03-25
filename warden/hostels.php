<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$warden_info_data = getWardenInfo($conn, $user_data['user_id']);
$warden_id = $warden_info_data['warden_id'];

$hostels = getHostels($conn, $warden_id);


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
        <?php for ($i = 0; $i < count($hostels); $i++) {
            $hostel = $hostels[$i];

            ?>
            <tr>
                <td class="counterCell"></td>
                <td><a href="./hostel.php?id=<?php echo $hostel['hostel_id'] ?>">
                        <?php echo $hostel['hostel_name'] ?>
                    </a>
                </td>
                <td><?php echo $hostel['hostel_address'] ?></td>
                <td><?php echo $hostel['hostel_capacity'] ?></td>
            </tr>
        <?php } ?>
    </table>


</body>

</html>