<?php
    include 'functions.php';    

    $zoeken = filter_input(INPUT_POST, "zoekresultaat", FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
    </head>
    <body class="bodi">

    <?php
    print(category());
    ?>
            <label>Select list</label>
<form action="search.php">
<select name="cars">
  <option value="asc">prijs laag hoog</option>
  <option value="desc">prijs hoog laag</option>
  <option value="populair">populair</option>
  <option value="newest">Newste</option>
</select>
<input type="submit" value="Submit">
</form>
    <?php
    zoeken($zoeken);
    ?>
    <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>
    </body>
</html>