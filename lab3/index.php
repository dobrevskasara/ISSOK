<?php

include './database/db_connection.php';

session_start();

include './jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ./pages/auth/login_form.php");
    exit();
}

$db = connectDatabase();

$query = "SELECT * FROM events";
$result = $db->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Events</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Event List</h1>
    <a href="./pages/add_event_form.php">Add Event</a>
    <a href="./pages/auth/login_form.php">Login</a>
    <a href="./handlers/auth/logout_handler.php">Logout</a>
</div>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Location</th>
        <th>Date</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($event = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($event['id']) ?></td>
                <td><?= htmlspecialchars($event['name']) ?></td>
                <td><?= htmlspecialchars($event['location']) ?></td>
                <td><?= htmlspecialchars($event['date']) ?></td>
                <td><?= htmlspecialchars($event['type']) ?></td>
                <td>
                    <form action="./handlers/delete_event_handler.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $event['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>

                    <form action="./pages/edit_event_form.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $event['id'] ?>">
                        <button type="submit">Edit</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No events found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
