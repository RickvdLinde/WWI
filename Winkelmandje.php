<?php
session_start();

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
        
        if(isset($_SESSION["naam"])){
            $naam = $_SESSION["naam"];
            print($naam . ": ");
        }
        $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_NUMBER_FLOAT);
        $_SESSION["aantal"] = $aantal;
        if(isset($_SESSION["aantal"]) && $_SESSION["aantal"] > 0){
            print($aantal);
        }
        ?>
    </body>
</html>
