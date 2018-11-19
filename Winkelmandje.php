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

        print("<h2>Producten in Winkelwagen</h2><br>");
        
        //Gegevens ophalen uit de tabel
        if (isset($_SESSION["naam"]) && isset($_SESSION["winkelwagen"]) && isset($_SESSION["aantal"]) && ($_SESSION["aantal"] > 0)) {
            $naam = $_SESSION["naam"];
            $winkelwagen = $_SESSION["winkelwagen"];
            $aantal = $_SESSION["aantal"];
            $prijs = $_SESSION["prijs"];
            $bedrag = $prijs * $aantal;
            // Zet een product in de array $winkelwagen
            $winkelwagen[$naam] = array($aantal, $bedrag);

            /* print("<table class=\"tabel\">");
              foreach ($winkelwagen as $key => $value) {
              print("<tr><td>" . $key . "</td><td>" . $value . "</td><td> €" . $bedrag . "</td><td><button>Verwijderen</button></td></tr>");
              $totaleBedrag = $totaleBedrag + $bedrag;
              } */
            
            //Laat gegevens van het product zien: Naam, aantal, prijs
            $totaleBedrag = 0;
            foreach ($winkelwagen as $key => $value) {
                print($key . " ");
                if (is_array($value)) {
                    print("aantal: " . $value[0] . " Prijs: €" . $value[1]);
                    print("<br>");
                } else {
                    print($value . "  <br>");
                }
            }
            
            // Berekent het totale bedrag
            foreach ($winkelwagen as $key => $value){
                if (is_array($value)){
                $totaleBedrag += $value[1];
                }
            }

            print("</table>");
            print("<br>Totale bedrag: €" . $totaleBedrag . "<br><br>");
            print("<a href=\"betalen.php\" class=\"betaalbutton\" >Naar betaalpagina</a>");
            $_SESSION["bedrag"] = $bedrag;
            $_SESSION["winkelwagen"] = $winkelwagen;
            $_SESSION["totalebedrag"] = $totaleBedrag;
        }
        ?>
    </div>
    <?php
    print(footer());
    ?>
</body>
</html>
