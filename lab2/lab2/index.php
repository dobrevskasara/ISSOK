<?php
include 'db_connection.php';
$db = connectDatabase();

$statusFilter = $_GET['status'] ?? '';

if (!empty($statusFilter)) {
    $stmt = $db->prepare("SELECT * FROM tasks WHERE status = :status ORDER BY due ASC, id ASC");
    $stmt->bindValue(':status', $statusFilter, SQLITE3_TEXT);
    $result = $stmt->execute();
} else {
    $result = $db->query("SELECT * FROM tasks ORDER BY due ASC, id ASC");
}

//if (!empty($priorityFilter)) {
//    $stmt = $db->prepare("SELECT * FROM tasks WHERE priority = :priority ORDER BY due ASC, id ASC");
//    $stmt->bindValue(':priority', $priorityFilter, SQLITE3_TEXT);
//    $result = $stmt->execute();
//} else {
//    $result = $db->query("SELECT * FROM tasks ORDER BY due ASC, id ASC");
//}

if (!$result) {
    die("Error fetching tasks: " . $db->lastErrorMsg());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Tasks</title>
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
    <h1>Task List</h1>
    <a href="add_task_form.php">
        Add Task
    </a>
</div>
<form method="GET" action="index.php" style="margin-bottom: 20px;">
    <label for="status">Filter status:</label>
    <select name="status" id="status">
        <option value="">All</option>
        <option value="Pending" <?php if(isset($_GET['status']) && $_GET['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
        <option value="Done" <?php if(isset($_GET['status']) && $_GET['status'] === 'Done') echo 'selected'; ?>>Done</option>
    </select>
    <button type="submit">Filter</button>
</form>
<!--<form method="GET" action="index.php" style="margin-bottom: 20px;">-->
<!--    <label for="priority">Filter priority:</label>-->
<!--    <select name="priority" id="priority">-->
<!--        <option value="">All</option>-->

<!--    </select>-->
<!--    <button type="submit">Filter</button>-->
<!--</form>-->
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Due</th>
        <th>Priority</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($task = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($task['id']); ?></td>
                <td><?php echo htmlspecialchars($task['title']); ?></td>
                <td><?php echo htmlspecialchars($task['due']); ?></td>
                <td><?php echo htmlspecialchars($task['priority']); ?></td>
                <td><?php echo htmlspecialchars($task['status']); ?></td>
                <td>
                    <form action="delete_task.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="update_task_form.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No tasks found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>