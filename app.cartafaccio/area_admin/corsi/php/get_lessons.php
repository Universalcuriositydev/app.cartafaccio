<?php
require 'config.php';

$courseId = $_GET['courseId'];
$stmt = $pdo->prepare('SELECT * FROM lessons WHERE course_id = ?');
$stmt->execute([$courseId]);
$lessons = $stmt->fetchAll();

echo json_encode($lessons);
?>
