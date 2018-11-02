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
        $a = 0;
        
        $zoeken = filter_input(INPUT_POST, "zoekresultaat", FILTER_SANITIZE_STRING);
        $search = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
        $search->execute(array("%$zoeken%"));
        $a = $search->rowCount();

            if($zoeken != NULL){
                foreach($search as $s) {
                    print $s['StockItemName'];
                    print(" - €");
                    print $s['RecommendedRetailPrice'];
                    print(" Voorraad: ");
                    print $s['QuantityOnHand'];
                    print("<br>");
                }
            print($a. " resultaten<br>");
            } else {
                if(empty($_POST) || $a == NULL){
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
