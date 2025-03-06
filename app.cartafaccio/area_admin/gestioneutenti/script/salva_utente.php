<?php
require_once('../../config.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conferma_password = $_POST["conferma_password"];
    $livello_permessi = $_POST["livello_permessi"];

    // Validate form data
    if(empty($username) || empty($email) || empty($password) || empty($conferma_password) || empty($livello_permessi)) {
        die("Tutti i campi sono obbligatori");
    }

    if($password !== $conferma_password) {
        die("Le password non corrispondono");
    }

    // Validate livello_permessi
    if($livello_permessi !== "utente" && $livello_permessi !== "admin") {
        die("Livello permessi non valido");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    } else {
        echo "Errore durante la registrazione dell'utente: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $connessione->close();
}
?>
