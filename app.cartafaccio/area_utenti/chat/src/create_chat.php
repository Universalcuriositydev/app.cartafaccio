<?php
require 'database.php';
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isLoggedIn() && verifyToken($_POST['token'])) {
    $topic = validateInput($_POST['topic']);
    $created_by = getUserId();

    try {
        $stmt = $conn->prepare("INSERT INTO chat (topic, created_by) VALUES (:topic, :created_by)");
        $stmt->bindParam(':topic', $topic);
        $stmt->bindParam(':created_by', $created_by);
        $stmt->execute();
        echo "Chat created successfully!";
    } catch(PDOException $e) {
        logError("Chat creation error: " . $e->getMessage());
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Unauthorized or invalid CSRF token";
}
?>
