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
        }
        if(isset($_SESSION["winkelwagen"])){
            $winkelwagen = $_SESSION["winkelwagen"];
        }
        if(isset($_SESSION["aantal"])){
            $aantal = $_SESSION["aantal"];
        }
        $winkelwagen[$naam] = $aantal;
        $_SESSION["winkelwagen"] = $winkelwagen;
        foreach($winkelwagen as $key => $value){
            print($key . $value . "<br>");
        }
        /*if(isset($_SESSION["winkelwagen"])){
            $winkelwagen = $_SESSION["winkelwagen"];
            foreach($winkelwagen as $key => $value){
                print($key . $value);
            }
        }*/
        ?>
    </body>
</html>
