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
    <body>
        <?php
        print(category());
        $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_NUMBER_FLOAT);
        $_SESSION["aantal"] = $aantal;
        if(isset($_SESSION["naam"])){
            $naam = $_SESSION["naam"];
        }
        if(isset($_GET["aantal"])){
            $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_STRING);
        }
        if(isset($_SESSION["prijs"])){
            $prijs = $_SESSION["prijs"];
        }
        if(isset($_SESSION["voorraad"])){
            $voorraad = $_SESSION["voorraad"];
        }
        $_SESSION["prijs"] = $prijs;
        $_SESSION["aantal"] = $aantal;
        if(is_numeric($aantal)){
            $overige = $aantal - $voorraad;
        }
        ?>
        <div>
            <?php
            if($aantal > 0 && $aantal <= $voorraad){
                print("Product is toegevoegd aan winkelwagen<br>");
            } elseif($aantal > $voorraad) {
                print($voorraad . " producten zijn nu op voorraad. De overige " . $overige . " zullen nabesteld worden. De levertijd zal hierdoor langer worden.<br>");
            } elseif($aantal <= 0){
                print("Aantal moet meer dan 0 zijn<br>");
            }
            ?>
            <a href="product.php?product=<?=$naam?>">Terug naar productpagina</a><br>
            <a href="Winkelmandje.php">Ga naar winkelwagen</a>
        </div>
        
    </body>
</html>