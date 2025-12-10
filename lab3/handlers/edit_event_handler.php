<?php

include '../database/db_connection.php';

session_start();

include '../jwt_helper.php';

if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
    header("Location: ../pages/auth/login_form.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $id = $_POST['id'];

    $db = connectDatabase();

    $stmt = $db->prepare("UPDATE events SET name=:name, location=:location, date=:date, type=:type WHERE id=:id");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':location', $location);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':id', $id);

    $result = $stmt->execute();

    $db->close();

    if($result){
        header("Location: ../index.php");
    }
}
