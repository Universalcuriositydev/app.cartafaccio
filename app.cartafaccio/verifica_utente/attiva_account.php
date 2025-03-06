<?php

// Includi il file di configurazione del database
require_once '../config.php';

// Verifica se l'email è stata passata come parametro nell'URL
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // Cerca l'utente con l'email specificata nel database
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = $connessione->query($query);

    // Se l'utente esiste nel database, aggiorna lo stato dell'account da "in attesa" ad "attivo"
    if($result->num_rows > 0) {
        $query = "UPDATE utenti SET status = 'attivo' WHERE email = '$email'";
        $result = $connessione->query($query);

        // Mostra un messaggio di conferma
        echo "Account attivato con successo.";
    } else {
        // Se l'utente non esiste nel database, mostra un messaggio di errore
        echo "Nessun utente trovato con questa email.";
    }
} else {
    // Se l'email non è stata passata come parametro nell'URL, mostra un messaggio di errore
    echo "Email non specificata.";
}

?>
``
