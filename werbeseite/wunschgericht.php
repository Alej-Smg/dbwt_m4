<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Paundra, Daran, 3290902
- Alejandro, Schmeing, 3203949
-->
<html lang="de">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="index.css">
<title>Wunschgericht</title>
</head>
<body>
<header>
	<div id="Logo">
	<p><a href="./index.php">E-Mensa Logo</a></p>
	</div>
	
</header>

<?php
// Verbindungsaufbau mit der Datenbank
$link= new mysqli("localhost",  // Host der Datenbank
"root",                 	    // Benutzername zur Anmeldung
"root",    					    // Passwort
"emensawerbeseite"      	    // Auswahl der Datenbanken (bzw. des Schemas)
								// optional port der Datenbank
);

if ($link->connect_error) {
	echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
	exit();
}
?>

<form action="wunschgericht.php" id="Wgericht" method="POST">
	<label for="name_Wgericht">Welches Gericht Wünschst du dir?</label>
	<input type="text" name="name_Wgericht" id="name_Wgericht" require><br>
	
	<label for="comment_Wgericht">Beschreibe dein Wunschgericht:</label><br>
	<textarea name="comment_Wgericht" id="comment_Wgericht" cols="30" rows="10" placeholder="Text hier..." form="Wgericht"></textarea><br>
		
	<label for="name_ersteller">Möchtest du uns deinen Namen Sagen?</label>
	<input type="text" name="name_ersteller" id="name_ersteller"><br>
			
	<label for="email_ersteller">Wie können wir Dich erreichen?</label>
	<input type="email" name="email_ersteller" id="email_ersteller" require><br>
			
	<input type="submit" value="Wunsch abschicken">
</form>

<?php
$name_Wgericht;
$comment_Wgericht = "";
$name_ersteller = "Anonym";
$email_ersteller;

if (isset($_POST["name_Wgericht"]) && !$link->connect_error){
	$countAnon;
	if (file_exists("countAnon.json")) {
		$countAnon = json_decode(file_get_contents("countAnon.json"), true);
	} else $countAnon = 0;

	$countAnon ++;
	// Variablen übertragen
	if (isset($_POST["name_Wgericht"])) $name_Wgericht = $_POST["name_Wgericht"];
	if (isset($_POST["comment_Wgericht"])) $comment_Wgericht = $_POST["comment_Wgericht"];
	if (isset($_POST["name_ersteller"])) $name_ersteller = $_POST["name_ersteller"];
	if (strlen($name_ersteller) < 1) $name_ersteller = "Anonym" . $countAnon;
	if (isset($_POST["email_ersteller"])) $email_ersteller = $_POST["email_ersteller"];

	file_put_contents("countAnon.json", json_encode($countAnon));
	unset($countAnon);

	
	// Querys erstellen
	$stmt = $link->prepare("INSERT INTO ersteller (Name, E_Mail) VALUES (?, ?)");
    $stmt->bind_param("ss", $name_ersteller, $email_ersteller);
    $stmt->execute();

	$stmt = $link->prepare("INSERT INTO wunschgericht (Name, Beschreibung, Erstellt_von) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name_Wgericht, $comment_Wgericht, $name_ersteller);
    $stmt->execute();

/**
 * $stmt = $link->prepare("INSERT INTO wunschgericht (vorname, email, gerichtname, beschreibung) VALUES (?, ?, ?, ?)");
 *   $stmt->bind_param("ssss", $vorname, $email, $gericht, $beschreibung);
 *  $stmt->execute();
 */
	// Querys an server schicken
	// if ($link->query($SQL_insert_ersteller)) echo "query 1 true\n";
	// else echo $link -> error . "\n";
	// if ($link->query($SQL_insert_wunschgericht)) echo "query 2 true\n";
	// else echo "query 2 fail\n";

	echo "Vielen Dank für Ihre Einsendung\n";

	unset($SQL_insert_wunschgericht, $SQL_insert_ersteller);
}
?>

<h2><a href="./index.php">Zurück</a></h2>
	
</body>
