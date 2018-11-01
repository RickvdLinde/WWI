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
        
        $zoeken = filter_input(INPUT_GET, "zoekresultaat",
        FILTER_SANITIZE_STRING);
        $search = $pdo->prepare("SELECT `StockItemName`, `RecommendedRetailPrice`  FROM `stockitems` WHERE `StockItemName` LIKE ?");
        $search->execute(array("%$zoeken%"));
        
        if ($search){
            foreach($search as $s) {
                print $s['StockItemName'];
                print(" - €");
                print $s['RecommendedRetailPrice'];
                print("<br>");
            }
        } else {
            if($zoeken == NULL){
                print("Geen resultaten");
        } else {
            print("Geen resultaten");
        }
        }
        
        $pdo = NULL;
        ?>
        <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>
    </body>
</html>
