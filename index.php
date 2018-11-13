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
            Welkom op onze pagina!
        </h1>
        
        <br/>
        
        <p class="tk border">
            Hier kunt u producten bekijken en bestellen
        </p>

        
    </body>
</html>
