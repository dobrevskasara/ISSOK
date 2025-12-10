<?php


include '../db_connection.php';

$db = connectDatabase();

$createTableQuery = <<<SQL
  CREATE TABLE IF NOT EXISTS events(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT NOT NULL,
      location TEXT NOT NULL,
      date DATE NOT NULL,
      type STRING NOT NULL
  );
SQL;

$result = $db->exec($createTableQuery);

if (!$result) {
    die("Creating table failed");
}
