<?php

session_start();

include '../../database/db_connection.php';
include '../../jwt_helper.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = connectDatabase();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    try{
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashed_password);

        $stmt->execute();
        echo "New user registered";
    }
    catch (Exception $e){
        if($e->getCode() === 23000){
            echo "The username already exists";
        }
        else{
            die("Error" . $e->getMessage());
        }
    }


}
