<!DOCTYPE html>
<!--
	- Praktikum DBWT. Autoren:
	- Paundra, Daran, 3290902
	- Alejandro, Schmeing, 3203949
-->
<html lang="de">
<head>
    <title>@yield('title')</title>
    <form method="get">
    <select name="no" id="page">
        <option value="1" selected>1</option>
        <option value="2">2</option>
    </select>
        <?php
        if(isset($_GET['no'])){
            $page = $_GET['no'];
        }
        ?>
    </form>



    <br>
</head>
<body bgcolor="#a52a2a">
<header>
    @section('header')
        Header
    @show
</header>
<main>
    @section('main')
        Main
    @show
</main>
<footer>
    @section('footer')
        Footer
    @show
</footer>
</body>
</html>