<?php

?>
<link rel="stylesheet" href="/hostel-management/styles/navbar.css">
<header>

    <div class="container">
        <div class="content">
            <a class="profile" href="/hostel-management/warden/profile.php"><img
                    src="/hostel-management/assets/profile.jpg" alt="profile"></a>
        </div>

        <div class="content">

            <menu>
                |<a href="/hostel-management/warden/dashboard.php">dashboard</a>|
                <a href="/hostel-management/warden/hostels.php">hostels</a>|
                <a href="/hostel-management/warden/residents.php">residents</a>|
                <a href="/hostel-management/warden/rooms.php">rooms</a>|
                <a href="/hostel-management/warden/payments.php">payments</a>|
                <a href="/hostel-management/warden/maintenance.php">maintenance</a>|
                <a href="/hostel-management/warden/feedbacks.php">feedbacks</a>|
                <a href="/hostel-management/warden/complaints.php">complaints</a>|


            </menu>
        </div>
        <div class="content logout">
            <form action="../logout.php" method="POST" onsubmit="return confirm('Are you sure you want to log out?');">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>