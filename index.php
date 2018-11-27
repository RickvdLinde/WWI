<?php
include "functions.php";
session_start();
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
            Welkom bij onze webshop!
        </p>

        <br>
        <p class="tk border">
            Exclusieve weekdeals
            <br>
            <!--foto's van deals met aanklikbare link -->
            <a href="product.php?product=<?php print(deals(135)); ?>"><img src="<?php print(photo(135)); ?>" class="deals"></a>
            <a href="product.php?product=<?php print(deals(138)); ?>"><img src="<?php print(photo(138)); ?>" class="deals"></a>
            <a href="product.php?product=<?php print(deals(142)); ?>"><img src="<?php print(photo(142)); ?>" class="deals"></a>
            <br>
            <!-- naam van product met bijhorende link-->
            <a class="dealtext" href="product.php?product=<?php print(deals(135)); ?>"><?php print(deals(135)); ?></a>
            <a class="dealtext" href="product.php?product=<?php print(deals(138)); ?>"><?php print(deals(138)); ?></a>
            <a class="dealtext" href="product.php?product=<?php print(deals(142)); ?>"><?php print(deals(142)); ?></a>    
            <br>
        </p><br><br>

        <?php
        print(footer());
        ?>
    </body>
</html>
