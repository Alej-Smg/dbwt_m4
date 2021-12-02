<!DOCTYPE html>
<!--
	- Praktikum DBWT. Autoren:
	- Paundra, Daran, 3290902
	- Alejandro, Schmeing, 3203949
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Alle Kategorien</title>
</head>
<body>

<article>
    <h1>Daten aus der Datenbank der Tabelle: Kategorie</h1>
    <p>Der Controller inkludiert das benötigte Model (kategorie.php in diesem Fall)
        und ruft die benötigte Funktion <code>db_kategorie_select_all()</code> zum Laden der Daten auf</p>
    <ul>
        @forelse($data as $a)
            <li>{{$a['name']}} {{$a['preis_intern']}}</li>
        @empty
            <li>Keine Daten vorhanden.</li>
        @endforelse
    </ul>
</article>
</body>
</html>