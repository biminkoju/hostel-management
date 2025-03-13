<?php

?>
<link rel="stylesheet" href="../styles/navbar.css">

<header>
    <div class="container">

        <div class="content">

            <menu>
                <a href="/hostel-management/resident/dashboard.php">dashboard</a>
                <a href="/hostel-management/resident/profile.php">profile</a>
                <a href="/hostel-management/resident/hostel-info.php">hostel-info</a>
                <a href="/hostel-management/resident/room-info.php">room-info</a>
                <a href="/hostel-management/resident/rent.php">rent</a>
                <a href="/hostel-management/resident/maintenance-request.php">maintenance-request</a>
                <a href="/hostel-management/resident/feedback.php">feedback</a>
            </menu>
        </div>
        <div class="content logout">
            <form action="../logout.php" method="POST" onsubmit="return confirm('Are you sure you want to log out?');">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>