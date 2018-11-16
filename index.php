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
        
        <h1 class="txet">
            Wide World Importers
        </h1>
        
        <br/>
        
        <p class="tk border">
            Welkom bij onze webshop!
        </p>
        
        <br>
        <p class="tk border">
        Exclusieve weekdeals,
        <br>
        <a href="product.php?product=Small 9mm replacement blades 9mm" ><img src="Images/Small 9mm replacement blades.jpg" class="deals"></a>
        <a href="product.php?product=Packing knife with metal insert blade (Yellow) 9mm"><img src="Images/Packing knife with metal insert blade.JPG" class="deals"></a>
        <a  href="product.php?product=Red and white urgent despatch tape 48mmx75m"><img src="Images/Red and white heavy urgent despatch tape.jpg"class="deals"></a>
        <br>
        <a class="dealtext" href="product.php?product=Small 9mm replacement blades 9mm">Small 9mm replacement blades</a>
        <a class="dealtext" href="product.php?product=Packing knife with metal insert blade (Yellow) 9mm">Packing knife with metal insert blade (Yellow) 9mm</a>
        <a class="dealtext" href="product.php?product=Red and white urgent despatch tape 48mmx75m">Red and white urgent despatch</a>   
        <br>
        </p>
      
    </body>
</html>
