<?php
include 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? '';
$title = $data['title'] ?? '';
$description = $data['description'] ?? '';

$response = ['success' => false];

if (!empty($id) && !empty($title) && !empty($description)) {
    $stmt = $connessione->prepare("UPDATE courses SET title = ?, description = ? WHERE id = ?");
    $stmt->bind_param('ssi', $title, $description, $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;
    }
    $stmt->close();
} else {
    $response['error'] = "ID, titolo o descrizione mancante";
}

echo json_encode($response);
?>
