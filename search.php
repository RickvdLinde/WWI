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
    <body>

    <?php
    print(category());
    ?>
        <p>
            <label>Select list</label>
            <select id = "myList">
               <option value = "1">sorteer</option>
               <option value = "2">prijs laag < hoog</option>
               <option value = "3">prijs hoog > laag</option>
               <option value = "4">Meest verkocht</option>
               <option value = "5">Nieuwst</option>
            </select>
        </p>
    <?php
    zoeken($zoeken);
    ?>
    <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>
    </body>
</html>