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
            Week deals, nu in de aanbieding!
        </h1>
        
        <br/>
        
        <p class="tk border">
            OP = OP <br/>
            Dus wees er snel bij!
        </p>
        <br>
        <div class="slider-holder">
        <span id="slider-image-1"></span>
        <span id="slider-image-2"></span>
        <span id="slider-image-3"></span>
        <div class="image-holder">
            <img src="Images/3 kg Courier post bag (White).jpg" class="slider-image" />
            <img src="Images/Chocolate beetles.jpg" class="slider-image" />
            <img src="Images/Chocolate echidnas.jpg" class="slider-image" />
        </div>
        <div class="button-holder">
            <a href="#slider-image-1" class="slider-change"></a>
            <a href="#slider-image-2" class="slider-change"></a>
            <a href="#slider-image-3" class="slider-change"></a>
        </div>
    </div>
        
    </body>
</html>
