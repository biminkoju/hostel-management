<?php
session_start();
include("../helper/dbcon.php");
include("../helper/functions.php");

$user_data = checklogin($conn);
rightRedirect($user_data);

$warden_info_data = getWardenInfo($conn, $user_data["user_id"]);
$warden_id = $warden_info_data['warden_id'];

$hostels = getHostels($conn, $warden_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complaints</title>
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
    <p>following are the complaints made by the residents of your hostel</p>

    <?php for ($i = 0; $i < count($hostels); $i++) {
        $hostel = $hostels[$i];
        ?>

        <p>
            complaints from "<a
                href="./hostel.php?id=<?php echo $hostel['hostel_id'] ?>"><?php echo $hostel['hostel_name'] ?></a>" hostel:
        </p>

        <table border=1>
            <tr>
                <th>S.N</th>
                <th>complaint id</th>
                <th>resident name</th>
                <th>status</th>
            </tr>
            <?php
            $complaints = getComplaints($conn, $hostel['hostel_id']);
            for ($j = 0; $j < count($complaints); $j++) {
                $complaint = $complaints[$j];
                ?>

                <tr>
                    <td class="counterCell"></td>
                    <td>
                        <a href="./complaint?id=<?php echo $complaint['complaint_id'] ?>">
                            <?php echo $complaint['complaint_id'] ?>
                        </a>
                    </td>
                    <td><?php echo $complaint['resident_name'] ?></td>
                    <td><?php echo $complaint['status'] ?></td>
                </tr>
            </table>
        <?php } ?>
    <?php } ?>
</body>

</html>