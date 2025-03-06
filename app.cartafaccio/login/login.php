<?php
require_once('../config.php');

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $username = $connessione->real_escape_string($_POST['username']);
    $password = $connessione->real_escape_string($_POST['password']);

    if(empty($username) || empty($password)) {
        header("location:../index.php?error=Username e/o password non possono essere vuoti");
        exit();
    }

    $sql_select = "SELECT * FROM users WHERE username = '$username'";

    if($result = $connessione->query($sql_select)){
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            if($row['status'] == 'in attesa') {
                header("location:../index.php?error=Account non verificato. Controlla la tua email per attivare l'account.");
                exit();
            }
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['loggato'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['livello_permessi'] = $row['livello_permessi'];
                if($row['livello_permessi'] == 'utente'){
                    header("location: ../area_personale/area_personale.php");
                } else if ($row['livello_permessi'] == 'admin') {
                    header("location: ../area_personale_admin/area_personale_admin.php");
                } else {
                    header("location:../index.php?error=Livello di permessi non valido");
                }
                exit();
            }else{
                header("location:../index.php?error=La password non è corretta");
                exit();
            }
        }else{
            header("location:../index.php?error=Non esistono account con questo username");
            exit();
        }
    }else{
        header("location:../index.php?error=Errore in fase di login");
        exit();
    }

    $connessione->close();
}
?>