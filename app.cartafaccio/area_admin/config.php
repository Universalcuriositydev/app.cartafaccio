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
if ($connessione->connect_error) {
    die("Errore durante la connessione: " . $connessione->connect_error);
}
?>
