<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $due = $_POST['due'] ?? '';
    $priority = $_POST['priority'] ?? ' ';
    $status = $_POST['status'] ?? '';

    if (empty($title) || empty($due) || empty ($priority) || empty($status)) {
        echo "Please fill in all required fields correctly.";
        exit;
    }

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

    // Connect to the SQLite database
    $db = connectDatabase();

    // Prepare and execute the insert statement
    $stmt = $db->prepare("INSERT INTO tasks (title, due, priority, status) VALUES (:title, :due, :priority, :status)");
    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':due', $due, SQLITE3_TEXT);
    $stmt->bindValue(':priority', $priority, SQLITE3_TEXT);
    $stmt->bindValue(':status', $status, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the view page
        header("Location: index.php");
    } else {
        echo "Error adding task: " . $db->lastErrorMsg();
    }

    // Close the database connection
    $db->close();
} else {
    // If not a POST request, display an error message
    echo "Invalid request method. Please submit the form to add a task.";
}
?>

