<?php
require_once('../config.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $connessione->real_escape_string($_POST['nome']);
    $cognome = $connessione->real_escape_string($_POST['cognome']);

    $username_gen = $nome . '.' . $cognome;

    $username = $connessione->real_escape_string($username_gen);
    $email = $connessione->real_escape_string($_POST['email']);
    $password = $connessione->real_escape_string($_POST['password']);
    $livello_permessi = 'utente'; // Imposta il livello di permessi a 'utente' di default
    $status = 'in attesa'; // Imposta lo status a 'in attesa' di default

    // Controlla se esiste già un account con quell'email
    $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
    $result_check_email = $connessione->query($sql_check_email);
    if($result_check_email->num_rows > 0) {
        header("location:../index.php?error=Esiste già un account con questa email");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                 //username
    $sql = "INSERT INTO users (nome,cognome,username,email,password,livello_permessi,status) VALUES ('$nome','$cognome','$username','$email','$hashed_password','$livello_permessi','$status')";

    if($connessione->query($sql) == true) {
        // Invia l'email di conferma
        $to = $email;
        $subject = "Conferma dell'account";
        $message = "Gentile utente,\n\nGrazie per aver creato un account sul nostro sito. Per completare la registrazione, clicca sul seguente link:\n\nhttp://cartafaccio.altervista.org/verifica_utente/attiva_account.php?email=".$email."\n\nCordiali saluti,\nIl team di cartafaccio";
        $headers = "From: cartafaccio.assistenza@gmail.com\r\n";

        if(mail($to, $subject, $message, $headers)) {
            echo "Registrazione effettuata con successo. Ti è stata inviata un'email di conferma per attivare il tuo account.";
        } else {
            echo "Si è verificato un errore durante l'invio dell'email di conferma.";
        }

        header("location: ../index.php");
        exit(); // Aggiungi questa linea per terminare lo script dopo la redirect
    } else {
        echo "Errore durante la registrazione: ".$connessione->error;
    }
}

?>