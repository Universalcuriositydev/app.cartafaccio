<?php
require 'database.php';
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isLoggedIn() && verifyToken($_POST['token'])) {
    $chat_id = validateInput($_POST['chat_id']);
    $user_id = getUserId();
    $message = validateInput($_POST['message']);

    try {
        $stmt = $conn->prepare("INSERT INTO messaggi (chat_id, user_id, message) VALUES (:chat_id, :user_id, :message)");
        $stmt->bindParam(':chat_id', $chat_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        header("Location: chat.php?chat_id=$chat_id");
    } catch(PDOException $e) {
        logError("Message send error: " . $e->getMessage());
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Unauthorized or invalid CSRF token";
}
?>
