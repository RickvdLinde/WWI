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
        $_SESSION["aantal"] = $aantal;
        ?>
        <div>
            <p>Products is toegevoegd aan winkelwagen</p>
            <a href="product.php?product=<?=$naam?>">Terug naar productpagina</a><br>
            <a href="Winkelmandje.php">Ga naar winkelwagen</a>
        </div>
        
    </body>
</html>