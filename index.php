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
            Wide World Importers
        </h1>
        
        <br/>
        
        <p class="tk border">
            Welkom bij onze webshop!
        </p>
        
        <br>
        
        <p class="tk border">
            Voor de weekdeals, 
            <a href="deals.php">klik hier!</a>
        </p>
        
    </body>
</html>
