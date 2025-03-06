<?php
include 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

// Recupera l'ID dalla query string
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$response = ['success' => false];

if ($id > 0) {
    $stmt = $connessione->prepare("DELETE FROM courses WHERE id = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Errore nella preparazione della query: ' . $connessione->error]);
        exit;
    }

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = "Errore durante l'eliminazione: " . $stmt->error;
    }
    $stmt->close();
} else {
    $response['error'] = "ID non valido o mancante";
}

echo json_encode($response);
exit;
?>
