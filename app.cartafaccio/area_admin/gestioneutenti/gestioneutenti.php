<!DOCTYPE html>
<html>
<head>
	<title>Gestione utenti</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<a href="../area_personale_admin/area_personale_admin.php">
<img src="img/freccia.png">
</a>
	<h1>Gestione utenti</h1>
	<table>
		<tr>
			<th>ID Utente</th>
			<th>Username</th>
			<th>Email</th>
            <th>Livello permessi</th>
			<th>Azioni</th>
		</tr>
		<?php
		require_once('../config.php');
        	$sql = "SELECT * FROM utenti";
	$result = $connessione->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["id_utente"] . "</td>";
			echo "<td>" . $row["username"] . "</td>";
			echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["livello_permessi"] . "</td>";
			echo "<td>
                    <a href='script/modifica_utente.php?id_utente=" . $row["id_utente"] . "'>Modifica</a> | 
                    <a href='script/elimina_utente.php?id_utente=" . $row["id_utente"] . "'>Elimina</a> | 
                    <a href='script/dettagli_utente.php?id_utente=" . $row["id_utente"] . "'>Dettagli</a></td>";
			echo "</tr>";
		}
	} else {
		echo "Nessun utente trovato";
	}
	$connessione->close();
	?>
</table>
<br>
<a href="script/aggiungi_utente.php">Aggiungi nuovo utente</a>
</body>
</html>