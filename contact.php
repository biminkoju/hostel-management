<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>

<body>
    <?php require_once "./util/navbar-home.php" ?>

    <h1>Contact</h1>
    <form method="post" action="./helper/send-email.php">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        <label for="email">email</label>
        <input type="email" name="email" id="email" required>
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" required>
        <label for="message">Message</label>
        <textarea type="text" name="message" id="message" required></textarea>
        <br>
        <button type="submit" name="submit">send</button>
    </form>
</body>

</html>