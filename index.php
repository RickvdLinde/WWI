<?php
session_start();
include "functions.php";
?>
<!DOCTYPE html>
<!-- Link de styling pagina's aan de html/php pagina-->
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
            <a href="http://localhost/WWI/info.php">Wide World Importers</a>
        </h1>

        <br/>

        <p class="tk border">
            Krijg allemaal bloedkanker!
        </p>

        <br>
        <p class="tk border">
            Recommended items
            <br>
            <?php
            //Zodra de variabel veranderd gaat de foto's en tekst mee, maar de foto's moetem wel beschikbaar zijn.
            $product1 = 135;
            $product2 = 138;
            $product3 = 142;
            ?>
            <!--foto's van recommend items met aanklikbare link -->
            <a href="product.php?product=<?php print(recommend($product1)); ?>"><img src="Images/<?php print ($product1); ?>.png" class="recommend"></a>
            <a href="product.php?product=<?php print(recommend($product2)); ?>"><img src="Images/<?php print ($product2); ?>.png" class="recommend"></a>
            <a href="product.php?product=<?php print(recommend($product3)); ?>"><img src="Images/<?php print ($product3); ?>.png" class="recommend"></a>
            <br>
            <!-- naam van product met bijhorende link-->
            <a class="dealtext" href="product.php?product=<?php print(recommend($product1)); ?>"><?php print(recommend($product1)); ?></a>
            <a class="dealtext" href="product.php?product=<?php print(recommend($product2)); ?>"><?php print(recommend($product2)); ?></a>
            <a class="dealtext" href="product.php?product=<?php print(recommend($product3)); ?>"><?php print(recommend($product3)); ?></a>   
            
             <!-- Prijs van product-->
             <a class="price2" href="product.php?product=<?php print(recommend($product1)); ?>"><?php print(price($product1)); ?></a>
             <a class="price" href="product.php?product=<?php print(recommend($product2)); ?>"><?php print(price($product2)); ?></a>
             <a class="price2" href="product.php?product=<?php print(recommend($product3)); ?>"><?php print(price($product3)); ?></a>
            
            <br>
        </p><br><br>

    </body>
</html>