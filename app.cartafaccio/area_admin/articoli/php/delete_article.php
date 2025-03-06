<?php
include 'config.php';

header('Content-Type: application/json');

// Attivare il logging degli errori per il debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? '';

$response = ['success' => false];

if (!empty($id)) {
    $stmt = $connessione->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;
    }
    $stmt->close();
} else {
    $response['error'] = "ID mancante";
}

echo json_encode($response);
?>
