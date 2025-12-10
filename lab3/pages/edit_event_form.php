<?php

include '../database/db_connection.php';


session_start();

include '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ./auth/login_form.php");
    exit();
}


if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $id = $_GET['id'];

    $db = connectDatabase();
    $stmt = $db->prepare("SELECT * FROM events where id=:id");
    $stmt->bindValue(':id', $id);
    $result = $stmt->execute();

    $event= $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
}
else{
    echo "Invalid request";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
</head>
<body>
<?php if($event): ?>
    <form action="../handlers/edit_event_handler.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($event['id']);?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($event['name']); ?>">
        <br />
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required value="<?php echo htmlspecialchars($event['location']); ?>">
        <br />
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required value="<?php echo htmlspecialchars($event['date']); ?>">
        <select name="type" value="<?php echo htmlspecialchars($event['type']); ?>">
            <option>Private</option>
            <option>Public</option>
        </select>
        <br />
        <button type="submit">Edit Event</button>
    </form>
<?php else:?>
    <p>Event not found.</p>
<?php endif; ?>
</body>
