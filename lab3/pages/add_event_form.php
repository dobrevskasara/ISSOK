<?php

session_start();

include '../jwt_helper.php';

if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
    header("Location: ./auth/login_form.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Event</title>
</head>
<body>
<form action="../handlers/add_event_handler.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br />
    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required>
    <br />
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required>
    <select name="type">
        <option>Private</option>
        <option>Public</option>
    </select>
    <br />
    <button type="submit">Add Event</button>
</form>
</body>
