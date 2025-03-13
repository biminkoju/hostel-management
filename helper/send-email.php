<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (!empty($email) && !empty($name) && !empty($subject) && !empty($message)) {
    } else {
        echo "please enter all the required fields";
    }

}

?>