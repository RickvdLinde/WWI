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
	print("<div class=\"productnaam\">" . $name . "<br></div>");
        print("<div class=\"productprijs\">Prijs: €" . $prijs) . "<br></div>";
        if($voorraad > 0){
            print("<div class=\"productopvoorraad\">Product is nog op voorraad</div>");
        } else {
            print("<div class=\"productnietvoorraad\">Product is niet op voorraad</div>");
        }
        ?>
        <div>
            <form method="get" action=Toevoegen.php>
                <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" placeholder="voorraad: <?=print($voorraad);?>..." name="aantal"><br>
                <input type="submit" name="submit" value="Toevoegen aan Winkelmandje">
            </form>
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
        $pdo = NULL;
        ?>
    </body>
</html>