<?php

?>
<link rel="stylesheet" href="../styles/index.css">
<header>
    <div class="container">

        <div class="content">

            <menu>
                <a href="/hostel-management/warden/dashboard.php">dashboard</a>
                <a href="/hostel-management/warden/residents.php">residents</a>
                <a href="/hostel-management/warden/rooms.php">rooms</a>
                <a href="/hostel-management/warden/payments.php">payments</a>
                <a href="/hostel-management/warden/maintenance.php">maintenance</a>

            </menu>
        </div>
        <div class="content log">
            <form action="../logout.php" method="POST" onsubmit="return confirm('Are you sure you want to log out?');">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>