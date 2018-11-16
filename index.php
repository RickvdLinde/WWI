<?php
include "functions.php";
session_start();
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
        ?>

        <h1 class="text">
        
        <h1 class="txet">
            Wide World Importers
        </h1>

        <br/>

        <p class="tk border">
            Welkom bij onze webshop!
        </p>

        <br>
        <p class="tk border">
        Exclusieve weekdeals
            <br>
                    <img src="Images/3 kg Courier post bag (White).JPG" class="deals">
        <img src="Images/Packing knife with metal insert blade.JPG" class="deals">
        <img src="Images/Red and white heavy urgent despatch tape.jpg" class="deals">
        <br>
        <a class="dealtext" href="product.php?product=3 kg Courier post bag (White) 300x190x95mm">3 kg Courier post bag (White)</a>
        <a class="dealtext" href="product.php?product=Packing knife with metal insert blade (Yellow) 9mm">Packing knife with metal insert blade (Yellow) 9mm</a>
        <a class="dealtext" href="product.php?product=Red and white urgent despatch tape 48mmx75m">Red and white urgent despatch</a>    
        </p>

    </body>
</html>
