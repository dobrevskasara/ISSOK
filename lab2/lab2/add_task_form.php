<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
</head>
<body>
<form action="add_task.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>
    <br />
    <label for="due">Due:</label>
    <input type="date" name="due" id="due" required>
    <br />
    <label for="priority">Priority:</label>
    <input type="text" name="priority" id="priority" required>
    <br />
    <label for="status">Status:</label>
    <input type="text" name="status" id="status" required>
    <br />
    <button type="submit">Add Task</button>
</form>
</body>