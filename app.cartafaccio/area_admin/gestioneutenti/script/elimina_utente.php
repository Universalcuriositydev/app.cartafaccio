<!DOCTYPE html>
<html>
<head>
 <title>Modifica Utente</title>
 <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
 <h1>Modifica Utente</h1>
 <?php
 require_once('../../config.php');
 if (isset($_GET['id_utente'])) {
  $id_utente = $_GET['id_utente'];
  $sql = "SELECT id_utente, username, email, livello_permessi FROM utenti WHERE id_utente = $id_utente";
  $result = $connessione->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $livello_permessi = $row['livello_permessi'];
  } else {
    echo "Utente non trovato";
    exit();
  }
} else {
 echo "ID utente non fornito";
 exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $username = $_POST['username'];
 $email = $_POST['email'];
 $livello_permessi = $_POST['livello_permessi'];

 $sql = "UPDATE utenti SET username='$username', email='$email', livello_permessi='$livello_permessi' WHERE id_utente=$id_utente";

 if ($connessione->query($sql) === TRUE) {
  echo "Utente aggiornato con successo";
 } else {
  echo "Errore durante l'aggiornamento dell'utente: " . $connessione->error;
 }
}
?>
<form method="post">
 <label for="username">Username:</label>
 <input type="text" name="username" value="<?php echo $username ?>" required>
 <label for="email">Email:</label>
 <input type="email" name="email" value="<?php echo $email ?>" required>
 <label for="livello_permessi">Livello Permessi:</label>
<select name="livello_permessi" required>

  <option value="utente" <?php if($row['livello_permessi'] == 'utente') echo 'selected'; ?>>Utente</option>
  <option value="admin" <?php if($row['livello_permessi'] == 'admin') echo 'selected'; ?>>Admin</option>
 </select>
 <input type="submit" value="Aggiorna">
</form>
</body>
</html>
