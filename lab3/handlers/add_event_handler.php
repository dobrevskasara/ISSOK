<?php

include '../database/db_connection.php';

session_start();

include '../jwt_helper.php';

if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
    header("Location: ../pages/auth/login_form.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'] ?? '';
    $location = $_POST['location'] ?? '';
    $date = $_POST['date'] ?? '';
    $type = $_POST['type'] ?? '';

    $db = connectDatabase();

    $stmt = $db->prepare("INSERT INTO events (name, location, date, type) VALUES (:name, :location, :date, :type)");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':location', $location);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':type', $type);

    $result = $stmt->execute();

    if($result) {
        header("Location: ../index.php");
    }
    else{
        echo $db->lastErrorMsg();
    }

    $db->close();
}
else{
    echo "Invalid method";
}