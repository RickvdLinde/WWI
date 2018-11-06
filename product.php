<?php
include "functions.php"
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
        $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        $naam = filter_input(INPUT_GET,
        "product", FILTER_SANITIZE_STRING);
        
        //$prijs = $pdo->prepare("SELECT UnitPrice FROM stockitems WHERE StockItemName = $naam");
        $stmt = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemName = ?");
        
        $stmt->execute(array($naam));
        
        
        while ($row = $stmt->fetch()) {

	$name = $row["StockItemName"];
        $price = $row["RecommendedRetailPrice"];
	print($name . "<br>" . "€" . $price);
}

        $pdo = NULL;
        ?>
    </body>
</html>