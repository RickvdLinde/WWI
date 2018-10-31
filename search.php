<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        $zoeken = $_GET['zoekresultaat'];
        // Prepare statement
        $search = $pdo->prepare("SELECT `StockItemName`, `RecommendedRetailPrice`  FROM `stockitems` WHERE `StockItemName` LIKE ?");
        // Execute with wildcards
        $search->execute(array("%$zoeken%"));
        // Echo results
        foreach($search as $s) {
        print $s['StockItemName'];
        print(" - €");
        print $s['RecommendedRetailPrice'];
        print("<br>");
        }
        ?>
        <a href="http://localhost/Workshopdatabase/index.php">Terug naar homepagina</a>
    </body>
</html>
