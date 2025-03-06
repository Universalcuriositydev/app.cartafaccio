<?php
include 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$sql = "SELECT id, title, description FROM courses";
$result = $connessione->query($sql);

if (!$result) {
    echo json_encode(["error" => "Errore query: " . $connessione->error]);
    exit();
}

$courses = [];
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

if (empty($courses)) {
    echo json_encode(["message" => "Nessun corso trovato"]);
} else {
    echo json_encode($courses);
}

$connessione->close();
