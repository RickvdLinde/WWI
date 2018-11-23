<?php
session_start();

include "functions.php"
?>
<!DOCTYPE html>
                
        <?php
        print(category());
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);      
        $naam = filter_input(INPUT_GET,
        "product", FILTER_SANITIZE_STRING);
        
                $naam = preg_replace('/_/', ' ', $naam);
        
        $stmt = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice, QuantityOnHand, MarketingComments, SupplierName FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID JOIN suppliers l
        ON s.SupplierID = l.SupplierID WHERE StockItemName LIKE ?");

        $stmt->execute(array("%$naam%"));

        while ($row = $stmt->fetch()) {

            $name = $row["StockItemName"];
            $prijs = $row["RecommendedRetailPrice"];
            $voorraad = $row["QuantityOnHand"];
            $comment = $row["MarketingComments"];
            $leverancier = $row["SupplierName"];
            ?>                 
                    
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Wide World Importers</title>
                    <link rel="icon" href="Images/archixl-logo.png">
                    <link rel="stylesheet" type="text/css" href="Mainstyle.css">
                    <link rel="stylesheet" type="text/css" href="style2.css">
                </head>
                <body class="bodi">

                <div class="slider-holder">
                    <span id="slider-image-1"></span>
                    <span id="slider-image-2"></span>
                    <span id="slider-image-3"></span>
                    <div class="image-holder">
                        <img src="Images/1.jpg" class="slider-image" />
                        <img src="Images/2.png" class="slider-image" />
                        <img src="Images/3.jpg" class="slider-image" />
                    </div>
                    <div class="button-holder">
                        <a href="#slider-image-1" class="slider-change"></a>
                        <a href="#slider-image-2" class="slider-change"></a>
                        <a href="#slider-image-3" class="slider-change"></a>
                    </div>
                </div>        
        
                    <?php
                    print("<div class=\"productnaam\">" . $name . "</div>");
                    if ($voorraad > 0) {
                        print('<div class="productopvoorraad">Product is op voorraad');
                    } else {
                        print('<div class="productnietvoorraad">Product is niet op voorraad');
                    }
                    ?>
                    <div class="formaantal">
                        <form method="get" action=Winkelmandje.php>
                            <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" name="aantal">
                            <input class="toevoegenbutton" type="submit" name="submit" value="Toevoegen aan Winkelmandje">
                        </form>
                    </div>
                    <?php print("<br><br><a href=\"leveranciers.php\" class=\"productleverancier\">Leverancier: " . $leverancier) . "</a>"; ?>
                </div>
            </div>
            <?php
            print("<div class=\"productprijs\">€" . $prijs) . "</div><br><br><br>";
        }
        $_SESSION["naam"] = $naam;
        if (isset($_SESSION["winkelwagen"])) {
            $winkelwagen = $_SESSION["winkelwagen"];
        }
        if (empty($winkelwagen)) {
            $winkelwagen = array();
        }
        $_SESSION["winkelwagen"] = $winkelwagen;
        $_SESSION["prijs"] = $prijs;
        $_SESSION["voorraad"] = $voorraad;
        $pdo = NULL;
        ?>
        <?php
        print(footer());
        ?>
    </body>
</html>