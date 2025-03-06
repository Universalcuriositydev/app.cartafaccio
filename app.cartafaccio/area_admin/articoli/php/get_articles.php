<?php
include 'config.php';

header('Content-Type: application/json');

// Attivare il logging degli errori per il debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = ['success' => false];
$sql = "SELECT id, title, text, status FROM articles";
$result = $connessione->query($sql);

if ($result === false) {
    $response['error'] = $connessione->error;
    echo json_encode($response);
    exit();
}

$articles = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

$response['success'] = true;
$response['articles'] = $articles;

echo json_encode($response);
?>
