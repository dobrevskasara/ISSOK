<?php

include '../db_connection.php';

$db = connectDatabase();

$createTableQuery = <<<SQL
CREATE TABLE IF NOT EXISTS users(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL
);
SQL;

$db->exec($createTableQuery);



