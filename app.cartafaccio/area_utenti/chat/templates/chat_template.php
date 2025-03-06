<?php $title = "Chat"; include('header.php'); ?>
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
<?php include('footer.php'); ?>
