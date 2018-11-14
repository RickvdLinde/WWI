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
        
    </body>
</html>
