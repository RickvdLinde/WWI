<?php
session_start();

include "functions.php"
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body class="bodi">
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
        $prijs = $row["RecommendedRetailPrice"];
        $voorraad = $row["QuantityOnHand"];
        $comment = $row["MarketingComments"];
        ?>
        <div class="productgegevens">
            <div class="image-placeholder">
                <h4>image placeholder</h4>
            </div>
        <?php
	print("<div class=\"productnaam\">" . $name . "<br><br></div>");
        print("<div class=\"productprijs\">Prijs: €" . $prijs) . "<br><br></div>";
        print("Producten op voorraad: " . $voorraad . "<br><br>");
        ?>
            <div>
                <form method="get" action=Toevoegen.php>
                    <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" name="aantal">
                    <input class="toevoegenbutton" type="submit" name="submit" value="Toevoegen aan Winkelmandje">
                </form>
            </div>
        </div>
        <?php
        }
        $_SESSION["naam"] = $naam;
        if(isset($_SESSION["winkelwagen"])){
            $winkelwagen = $_SESSION["winkelwagen"];
        }
        if(empty($winkelwagen)){
            $winkelwagen = array();
        }
        $_SESSION["winkelwagen"] = $winkelwagen;
        $_SESSION["prijs"] = $prijs;
        $_SESSION["voorraad"] = $voorraad;
        $pdo = NULL;
        ?>
    </body>
</html>