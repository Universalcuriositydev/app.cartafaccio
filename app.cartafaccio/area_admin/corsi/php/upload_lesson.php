<?php
include 'config.php';

header('Content-Type: application/json');

$courseId = $_POST['courseId'] ?? '';
$title = $_POST['title'] ?? '';
$chapter = $_POST['chapter'] ?? '';
$section = $_POST['section'] ?? '';
$video = $_FILES['video'] ?? null;

$response = ['success' => false];

$uploadDir = realpath(__DIR__ . '/../uploads') . '/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!empty($courseId) && !empty($title) && !empty($chapter) && !empty($section) && !empty($video)) {
    $videoPath = $uploadDir . basename($video['name']);
    if (move_uploaded_file($video['tmp_name'], $videoPath)) {
        $relativePath = 'uploads/' . basename($video['name']);
        $stmt = $connessione->prepare("INSERT INTO lessons (course_id, title, chapter, section, video) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $response['error'] = 'Prepare failed: ' . htmlspecialchars($connessione->error);
            echo json_encode($response);
            exit;
        }
        $stmt->bind_param('issss', $courseId, $title, $chapter, $section, $relativePath);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = $stmt->error;
        }
        $stmt->close();
    } else {
        $response['error'] = "Errore nel caricamento del video";
    }
} else {
    $response['error'] = "Dati mancanti per la lezione";
}

echo json_encode($response);
?>
