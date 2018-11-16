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
        <link rel="stylesheet" type="text/css" href="style2.css">
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
        <a href="product.php?product=Small 9mm replacement blades 9mm" ><img src="Images/211.jpg" class="deals"></a>
        <a href="product.php?product=Packing knife with metal insert blade (Yellow) 9mm"><img src="Images/209-210.jpg" class="deals"></a>
        <a  href="product.php?product=Red and white urgent despatch tape 48mmx75m"><img src="Images/202.jpg"class="deals"></a>
        <br>
        <a class="dealtext" href="product.php?product=Small 9mm replacement blades 9mm">Small 9mm replacement blades</a>
        <a class="dealtext" href="product.php?product=Packing knife with metal insert blade (Yellow) 9mm">Packing knife with metal insert blade (Yellow) 9mm</a>
        <a class="dealtext" href="product.php?product=Red and white urgent despatch tape 48mmx75m">Red and white urgent despatch</a>   
        <br>
        </p><br><br>
      
        <?php
        print(footer());
        ?>
    </body>
</html>
