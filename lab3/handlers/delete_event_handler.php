<?php

include '../database/db_connection.php';

session_start();

include '../jwt_helper.php';

if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
    header("Location: ../pages/auth/login_form.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
    $id = $_POST['id'];

    $db = connectDatabase();
    $stmt = $db->prepare("SELECT * FROM events WHERE id==:id");
    $stmt->bindValue(':id', $id);
    $result = $stmt->execute();

    $event = $result->fetchArray(SQLITE3_ASSOC);
    if($event['type'] == 'Private'){
        echo "Private event can't be erased.";
        exit();
    }
    $stmt = $db->prepare("DELETE FROM events WHERE id==:id");
    $stmt->bindValue(':id', $id);
    $result = $stmt->execute();

    if($result){
        header("Location: ../index.php");
    }

    $db->close();
}
else{
    echo "Invalid request";
}
