<?php
session_start();

include "functions.php"
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="icon" href="Images/archixl-logo.png">
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body class="bodi">
        <?php
        print(category());
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);      
        $naam = filter_input(INPUT_GET,
        "product", FILTER_SANITIZE_STRING);
        
                $naam = preg_replace('/_/', ' ', $naam);
        
        $stmt = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice, QuantityOnHand, MarketingComments FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName = ?");

        $stmt = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice, QuantityOnHand, MarketingComments, SupplierName FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID JOIN suppliers l
        ON s.SupplierID = l.SupplierID WHERE StockItemName LIKE ?");

        $stmt->execute(array("%$naam%"));

        $stmt->execute(array($naam));


        while ($row = $stmt->fetch()) {

            $name = $row["StockItemName"];
            $prijs = $row["RecommendedRetailPrice"];
            $voorraad = $row["QuantityOnHand"];
            $comment = $row["MarketingComments"];
            $leverancier = $row["SupplierName"];
            ?>
            <div class="productgegevens">
                <div class="image-placeholder">
                    <h4>image placeholder</h4>
                </div>
                <div class="gegevenszonderafbeeling">
                    <?php
                    print("<div class=\"productnaam\">" . $name . "</div>");
                    print("<div class=\"productvoorraad\">Producten op voorraad: " . $voorraad . "<br><br>");
                    ?>
                    <div class="formaantal">
                        <form method="get" action=Toevoegen.php>
                            <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" name="aantal">
                            <input class="toevoegenbutton" type="submit" name="submit" value="Toevoegen aan Winkelmandje">
                        </form>
                    </div>
                    <?php print("<br><br><a href=\"contact.php\" class=\"productleverancier\">Leverancier: " . $leverancier) . "</a>"; ?>
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