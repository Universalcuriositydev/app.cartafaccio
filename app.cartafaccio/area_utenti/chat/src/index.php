<?php
require 'database.php';
require 'functions.php';

if (!isLoggedIn()) {
    header("Location: ../templates/login.html");
    exit();
}

try {
    $stmt = $conn->prepare("SELECT * FROM chat");
    $stmt->execute();
    $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    logError("Fetch chats error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat List</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Available Chats</h1>
        <ul>
            <?php if ($chats): ?>
                <?php foreach ($chats as $chat): ?>
                    <li><a href="chat.php?chat_id=<?php echo $chat['id']; ?>"><?php echo htmlspecialchars($chat['topic']); ?></a></li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No chats available.</p>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
