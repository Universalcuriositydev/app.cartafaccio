<?php
require 'database.php';
require 'functions.php';

if (!isLoggedIn()) {
    header("Location: ../templates/login.html");
    exit();
}

$chat_id = validateInput($_GET['chat_id']);

try {
    $stmt = $conn->prepare("SELECT messaggi.*, utenti.username FROM messaggi JOIN utenti ON messaggi.user_id = utenti.id WHERE chat_id = :chat_id ORDER BY messaggi.created_at ASC");
    $stmt->bindParam(':chat_id', $chat_id);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    logError("Fetch messages error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
}
?>
<?php $title = "Chat"; include('../templates/header.php'); ?>
    <ul>
        <?php if ($messages): ?>
            <?php foreach ($messages as $message): ?>
                <li>
                    <strong><?php echo htmlspecialchars($message['username']); ?>:</strong>
                    <?php echo htmlspecialchars($message['message']); ?>
                    <em>(<?php echo $message['created_at']; ?>)</em>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No messages.</p>
        <?php endif; ?>
    </ul>
    <form action="send_message.php" method="POST">
        <input type="hidden" name="chat_id" value="<?php echo $chat_id; ?>">
        <input type="hidden" name="token" value="<?php echo generateToken(); ?>">
        <textarea name="message" placeholder="Type your message" required></textarea><br>
        <button type="submit">Send</button>
    </form>
<?php include('../templates/footer.php'); ?>
