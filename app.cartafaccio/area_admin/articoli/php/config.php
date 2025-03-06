<?php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'cartafaccio.assistenza@gmail.com');
define('SMTP_PASSWORD', 'cartafaccio.altervista.org');
define('SMTP_PORT', 587);
define('BASE_URL', 'https://cartafaccio.altervista.org');

$host = "127.0.0.1";
$user = "root";
$password = "";
$db = "cartafaccio_db";

// Attivare la visualizzazione degli errori (solo per debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connessione al database
$connessione = new mysqli($host, $user, $password, $db);

// Verifica se la connessione è avvenuta con successo
if (!$connessione) {
    error_log("Database connection failed: " . mysqli_connect_error());
}

if (empty($title) || empty($text)) {
    error_log("Invalid input: title or text is empty");
}

if (isset($response['error'])) {
    error_log("Error in response: " . $response['error']);
}

?>
