<?php
include "functions.php";
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link href="Mainstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <body class="bodi">
        <?php
        print(category());
        ?>
        
             <h1 class="text">Week deals, nu in de aanbieding!</h1>
             <br>
        <img src="Images/3 kg Courier post bag (White).JPG" class="deals">
        <img src="Images/Packing knife with metal insert blade.JPG" class="deals">
        <img src="Images/Red and white heavy urgent despatch tape.jpg" class="deals">
        <br>
        <?php
         print(deals());
       ?>
    </body>
    
</html>
