<?php
require_once('../../config.php');

if (isset($_GET['id_utente'])) {
    $id_utente = $_GET['id_utente'];

    $sql = "SELECT * FROM utenti WHERE id_utente = $id_utente";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>Dettagli utente</h2>";
        echo "<p>ID Utente: " . $row['id_utente'] . "</p>";
        echo "<p>Username: " . $row['username'] . "</p>";
        echo "<p>Email: " . $row['email'] . "</p>";
    } else {
        echo "Nessun utente trovato con questo ID";
    }
} else {
    echo "ID utente non fornito";
}

$connessione->close();
?>