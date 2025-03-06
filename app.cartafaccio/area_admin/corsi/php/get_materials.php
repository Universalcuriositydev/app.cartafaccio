<?php
include 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$courseId = $data['courseId'] ?? '';

$response = ['success' => false];

if (!empty($courseId)) {
    $stmt = $connessione->prepare("SELECT file_path FROM materials WHERE course_id = ?");
    $stmt->bind_param('i', $courseId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $materials = [];
    while($row = $result->fetch_assoc()) {
        $materials[] = $row;
    }
    $stmt->close();

    $response['success'] = true;
    $response['materials'] = $materials;
} else {
    $response['error'] = "ID del corso mancante";
}

echo json_encode($response);
?>
