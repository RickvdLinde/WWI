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
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>
        <?php
        print(category());
        print("<div class=\"borderpagina\">");
        $totaleBedrag = 0;
        
        print("<h2>Producten in Winkelwagen</h2><br>");
        
        if(isset($_SESSION["naam"]) && isset($_SESSION["winkelwagen"]) && isset($_SESSION["aantal"]) && ($_SESSION["aantal"] > 0)){
            $naam = $_SESSION["naam"];
            $winkelwagen = $_SESSION["winkelwagen"];
            $aantal = $_SESSION["aantal"];
            $prijs = $_SESSION["prijs"];
            $winkelwagen[$naam] = $aantal;
        
        foreach($winkelwagen as $key => $value){
            $bedrag = $prijs * $value;
            print($key . ": " . $value . " - €" . $bedrag . " <button>Verwijderen</button><br>");
            $totaleBedrag = $totaleBedrag + $bedrag;
        }
        print("<br>Totale bedrag: €" . $totaleBedrag . "<br><br>");
        print("<a href=\"betalen.php\" class=\"betaalbutton\" >Naar betaalpagina</a>");
        $_SESSION["bedrag"] = $bedrag;
        $_SESSION["winkelwagen"] = $winkelwagen;
        $_SESSION["totalebedrag"] = $totaleBedrag;
        }
        ?>
        </div>
    </body>
</html>
