<?php
include 'config.php';

header('Content-Type: application/json');

// Attivare il logging degli errori per il debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'] ?? '';
$text = $data['text'] ?? '';

$response = ['success' => false];

if (!empty($title) && !empty($text)) {
    $stmt = $connessione->prepare("INSERT INTO articles (title, text, status) VALUES (?, ?, 'bozza')");
    $stmt->bind_param('ss', $title, $text);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;
    }
    $stmt->close();
} else {
    $response['error'] = "Titolo o testo vuoto";
}

echo json_encode($response);
?>