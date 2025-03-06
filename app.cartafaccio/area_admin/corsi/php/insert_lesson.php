<?php
include 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$courseId = $data['courseId'] ?? '';
$title = $data['title'] ?? '';
$content = $data['content'] ?? '';

$response = ['success' => false];

if (!empty($courseId) && !empty($title) && !empty($content)) {
    $stmt = $connessione->prepare("INSERT INTO lessons (course_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $courseId, $title, $content);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;
    }
    $stmt->close();
} else {
    $response['error'] = "ID del corso, titolo o contenuto mancante";
}

echo json_encode($response);
?>
