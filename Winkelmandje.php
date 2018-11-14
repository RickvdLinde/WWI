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
        
        $naam = $_SESSION["naam"];
        $winkelwagen = $_SESSION["winkelwagen"];
        $aantal = $_SESSION["aantal"];
        $prijs = $_SESSION["prijs"];
        $totaleBedrag = 0;
        
        if(isset($_SESSION["naam"]) && isset($_SESSION["winkelwagen"]) && isset($_SESSION["aantal"]) && ($_SESSION["aantal"] > 0)){
            $winkelwagen[$naam] = $aantal;
            $_SESSION["winkelwagen"] = $winkelwagen;
        }
        foreach($winkelwagen as $key => $value){
            $bedrag = $prijs * $value;
            print($key . ": " . $value . " - " . $bedrag . " <button>Verwijderen</button><br>");
            $totaleBedrag = $totaleBedrag + $bedrag;
        }
        print("Totale bedrag: €" . $totaleBedrag);
        $_SESSION["bedrag"] = $bedrag;
        ?>
    </body>
</html>
