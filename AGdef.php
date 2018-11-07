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
  
          // Verbinding maken database
        $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        // voorbereiden query selecteren items van een categorie
  $AGassign = filter_input(INPUT_GET, $AGs , FILTER_SANITIZE_STRING);
        
$stmt = $pdo->prepare("select * from stockitems SI join 
    stockitemstockgroups SISG on SI.StockItemID=SISG.StockItemID 
    join stockgroups SG on SISG.StockGroupID=SG.StockGroupID 
    where StockItemName = ? order by StockItemName"); 

// Uitvoeren query 
$stmt->execute(array($AGassign));


// Resultaten verwerken namen items
while ($row = $stmt->fetch()) {

	$CitemGroupName = $row["StockItemName"];
        print($CitemGroupName);
}
// verbinding opruimen
$pdo = NULL;        
?>

    </body>
</html>
