<?php
session_start();
include "functions.php";
$logonname = "";
$_SESSION['LogonName2'] = welkom($logonname);
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
        ?>

        <h1 class="txet">
            Wide World Importers
        </h1>

        <br/>

        <p class="tk border">
            Welcome to our website!
        </p>

        <br>
        <p class="tk border">
            Weekly exclusive deals
            <br>
            <?php
            //Zodra de variabel veranderd gaat de foto's en tekst mee, maar de foto's moetem wel beschikbaar zijn.
            $product1 = 135;
            $product2 = 138;
            $product3 = 142;
            ?>
            <!--foto's van deals met aanklikbare link -->
            <a href="product.php?product=<?php print(deals($product1)); ?>"><img src="Images/<?php print ($product1); ?>.png" class="deals"></a>
            <a href="product.php?product=<?php print(deals($product2)); ?>"><img src="Images/<?php print ($product2); ?>.png" class="deals"></a>
            <a href="product.php?product=<?php print(deals($product3)); ?>"><img src="Images/<?php print ($product3); ?>.png" class="deals"></a>
            <br>
            <!-- naam van product met bijhorende link-->
            <a class="dealtext" href="product.php?product=<?php print(deals($product1)); ?>"><?php print(deals($product1)); ?></a>
            <a class="dealtext" href="product.php?product=<?php print(deals($product2)); ?>"><?php print(deals($product2)); ?></a>
            <a class="dealtext" href="product.php?product=<?php print(deals($product3)); ?>"><?php print(deals($product3)); ?></a>    
            <br>
        </p><br><br>

        <?php
        print(footer());
        ?>
    </body>
</html>
