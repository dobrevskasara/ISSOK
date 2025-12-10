<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    // Fetch the current details of the student
    $stmt = $db->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $task = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid task ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
</head>
<body>
<h1>Update Task</h1>

<?php if ($task): ?>
    <form action="update_task.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id']); ?>">

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>

        <label for="due">Due:</label>
        <input type="date" id="due" name="due" value="<?php echo htmlspecialchars($task['due']); ?>" required><br><br>

        <label for="priority">Priority:</label>
        <input type="text" id="priority" name="priority" value="<?php echo htmlspecialchars($task['priority']); ?>" required><br><br>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($task['status']); ?>" required><br><br>

        <button type="submit">Update Task</button>
    </form>

<?php else: ?>
    <p>Task not found.</p>
<?php endif; ?>
</body>
</html>