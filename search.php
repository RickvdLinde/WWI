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
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>

        <?php
        print(category());
        ?>
        <p>
            <label>Select list</label>
            <select id = "myList">
                <option value = "1">sorteer</option> 
                <option value = "2">prijs laag naar hoog</option> SELECT RecommendedRetailPrice FROM stockitems ORDER BY RecommendedRetailPrice ASC
                <option value = "3">prijs hoog naar laag</option> SELECT RecommendedRetailPrice FROM stockitems ORDER BY RecommendedRetailPrice DESC
                <option value = "4">Naam A tot Z</option> SELECT StockItemName FROM stockitems ORDER BY StockItemName ASC
                <option value = "5">Naam Z tot A</option> SELECT StockItemName FROM stockitems ORDER BY StockItemName DESC
               <option value = "1">Sorteer</option> 
               <option value = "2">Prijs laag naar hoog</option> SELECT RecommendedRetailPrice FROM stockitems ORDER BY RecommendedRetailPrice ASC
               <option value = "3">Prijs hoog naar laag</option> SELECT RecommendedRetailPrice FROM stockitems ORDER BY RecommendedRetailPrice DESC
               <option value = "4">Naam A tot Z</option> SELECT StockItemName FROM stockitems ORDER BY StockItemName ASC
               <option value = "5">Naam Z tot A</option> SELECT StockItemName FROM stockitems ORDER BY StockItemName DESC
            </select>
        </p>
        <?php
        zoeken($zoeken);
        ?>
        <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>
        <?php
        print(footer());
        ?>
    </body>
</html>