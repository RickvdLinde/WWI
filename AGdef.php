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

  $AGs = filter_input(INPUT_GET,
    "productgroup", FILTER_SANITIZE_STRING);
  //print($AGs); 

  $AGs = filter_input(INPUT_GET, "productgroup", FILTER_SANITIZE_STRING);
  //print($AGs); //we kennen hem weer!!

  
          // Verbinding maken database
    $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    
        
        // voorbereiden query selecteren items van een categorie
  
        
$stmt = $pdo->prepare("SELECT * 
                      FROM stockitems SI join stockitemstockgroups SISG 
                      ON SI.StockItemID=SISG.StockItemID 
                      JOIN stockgroups SG on SISG.StockGroupID=SG.StockGroupID 
                      WHERE StockItemName LIKE ?
                      ORDER BY StockItemName"); 

// Uitvoeren query 
$stmt->execute(array("%$AGs%"));


// Resultaten verwerken namen items
while ($row = $stmt->fetch()) {
	$CitemGroupName = $row["StockItemName"];
        print($CitemGroupName . "<br>");
}
// verbinding opruimen
$pdo = NULL;        
?>

    </body>
</html>
