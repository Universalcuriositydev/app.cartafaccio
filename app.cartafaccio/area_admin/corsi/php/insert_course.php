<?php
include 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'] ?? '';
$description = $data['text'] ?? '';
$type = $data['type'] ?? '';

$response = ['success' => false];

if (!empty($title) && !empty($description)) {
    $sql = "INSERT INTO courses (title, description) VALUES (?, ?)";
    $stmt = $connessione->prepare($sql);
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;

    }
    $stmt->close();
} else {
    $response['error'] = "Titolo, descrizione o tipo vuoto";
}

echo json_encode($response);
?>
