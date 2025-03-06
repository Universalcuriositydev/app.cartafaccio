<?php
include 'config.php';

header('Content-Type: application/json');

$courseId = $_POST['courseId'] ?? '';
$files = $_FILES['files'] ?? [];

$response = ['success' => false];

// Directory di upload
$uploadDir = __DIR__ . '/../uploads/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!empty($courseId) && !empty($files)) {
    foreach ($files['name'] as $key => $name) {
        $tmpName = $files['tmp_name'][$key];
        $filePath = $uploadDir . basename($name);
        if (move_uploaded_file($tmpName, $filePath)) {
            $relativePath = 'uploads/' . basename($name);
            $sql = "INSERT INTO materials (course_id, file_path) VALUES ('$courseId', '$relativePath')";
            if (!$connessione->query($sql)) {
                $response['error'] = $connessione->error;
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error'] = "Errore nel caricamento del file: $name";
            echo json_encode($response);
            exit();
        }
    }
    $response['success'] = true;
} else {
    $response['error'] = "ID del corso o file mancante";
}

echo json_encode($response);
?>
