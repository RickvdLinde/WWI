<?php
function zoeken($zoeken){
    $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    
        $search = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
        $search->execute(array("%$zoeken%"));
        $a = $search->rowCount();

            if($zoeken != NULL){
                foreach($search as $s) {
                    print ($s['StockItemName'] . " - €" . $s['RecommendedRetailPrice'] . " Voorraad: " . $s['QuantityOnHand'] . "<br>");
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
}
