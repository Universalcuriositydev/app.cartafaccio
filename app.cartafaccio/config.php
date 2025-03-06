<?php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'cartafaccio.assistenza@gmail.com');
define('SMTP_PASSWORD', 'cartafaccio.altervista.org');
define('SMTP_PORT', 587);
define('BASE_URL', 'https://cartafaccio.altervista.org');



$host = "127.0.0.1"; // Modifica 'localhost' in '127.0.0.1'
$user = "root"; // Cambia questo se il tuo utente di MySQL è diverso
$password = ""; // Cambia questo se hai una password per il tuo database
$db = "cartafaccio_db";

// Connessione al database
$connessione = new mysqli($host, $user, $password, $db);

// Verifica se la connessione è avvenuta con successo
if ($connessione->connect_error) {
    die("Errore durante la connessione: " . $connessione->connect_error);
} 
?>
