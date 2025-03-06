<!DOCTYPE html>
<html>
<head>
    <title>Aggiungi nuovo utente</title>
    <link rel="stylesheet" type="text/css" href="../css/style1.css">
</head>
<body>
    <h1>Aggiungi nuovo utente</h1>
    <form method="post" action="salva_utente.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <label for="conferma_password">Conferma password:</label>
        <input type="password" id="conferma_password" name="conferma_password" required>
        <br><br>
        <label for="livello_permessi">Livello permessi:</label>
        <select id="livello_permessi" name="livello_permessi">
            <option value="utente">Utente</option>
            <option value="admin">Admin</option>
        </select>
        <br><br>
        <input type="submit" value="Aggiungi utente">
        <input type="reset" value="Reset">
    </form>
    <br>
    <a href="../gestioneutenti.php">Torna alla lista utenti</a>
</body>
</html>
