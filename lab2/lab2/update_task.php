<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $due = $_POST['due'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $db = connectDatabase();

    $valid_priorities = ['Low', 'Medium', 'High'];
    if (!in_array($priority, $valid_priorities)) {
        $errors[] = "Priority must be one of: Low, Medium, High.";
    }

    $valid_statuses = ['Pending', 'Done'];
    if (!in_array($status, $valid_statuses)) {
        $errors[] = "Status must be one of: pending or done.";
    }


    if (!empty($errors)) {
        echo "<h3>Errors:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<a href='add_task_form.php'>Back</a>";
        exit;
    }

    // Update student details
    $stmt = $db->prepare("UPDATE tasks SET title = :title, due = :due, priority = :priority, status = :status WHERE id = :id");
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':due', $due, SQLITE3_TEXT);
    $stmt->bindValue(':priority', $priority, SQLITE3_TEXT);
    $stmt->bindValue(':status', $status, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    // Close the database connection
    $db->close();

    // Redirect back to the view page
    header("Location: index.php");
    exit();
} else {
    echo "Invalid request.";
}