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
        
        $stmt = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice, QuantityOnHand, MarketingComments FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName = ?");
        
        $stmt->execute(array($naam));
        
        while ($row = $stmt->fetch()) {

	$name = $row["StockItemName"];
        $price = $row["RecommendedRetailPrice"];
        $hoeveelheid = $row["QuantityOnHand"];
        $comments = $row["MarketingComments"];
	print("Naam: " . $name . "<br>" . "Prijs: €" . $price . "<br>Marketing comment: " . $comments . "<br>");
        ?>
        <div>
            <form method="get" action="product.php">
                <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" name="aantal"><br>
                <input type="submit" value="Toevoegen aan Winkelmandje">
            </form>
        </div>
        <?php
        }

        $pdo = NULL;
        ?>
    </body>
</html>