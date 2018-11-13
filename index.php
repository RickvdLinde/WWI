<?php
include "functions.php"
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
            Welkom op onze pagina!
        </h1>
        
        <br/>
        
        <p class="tk border">
            Hier kunt u producten bekijken en bestellen
        </p>
        <br>
        <div class="slider-holder">
        <span id="slider-image-1"></span>
        <span id="slider-image-2"></span>
        <span id="slider-image-3"></span>
        <div class="image-holder">
            <img src="Images/usb.jpg" class="slider-image" />
            <img src="Images/usb.jpg" class="slider-image" />
            <img src="Images/usb.jpg" class="slider-image" />
        </div>
        <div class="button-holder">
            <a href="#slider-image-1" class="slider-change"></a>
            <a href="#slider-image-2" class="slider-change"></a>
            <a href="#slider-image-3" class="slider-change"></a>
        </div>
    </div>
        
    </body>
</html>
