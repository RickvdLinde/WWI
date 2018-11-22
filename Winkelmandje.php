<?php
session_start();
if (isset($_SESSION["logged_in"])) {
    $loggedin = true;
} else {
    $loggedin = false;
}
include "functions.php"
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
        <link rel="stylesheet" type="text/css" href="style2.css">
        <link rel="icon" href="Images/archixl-logo.png">
    </head>
    <body>
        <?php
        print(category());
        print("<div class=\"borderpagina\">");

        print("<h2>Producten in Winkelwagen</h2><br>");

        //Gegevens ophalen uit de tabel
        if (isset($_SESSION["naam"]) && isset($_SESSION["winkelwagen"]) && isset($_SESSION["voorraad"])) {
            $naam = $_SESSION["naam"];
            $winkelwagen = $_SESSION["winkelwagen"];
            $prijs = $_SESSION["prijs"];
            $voorraad = $_SESSION["voorraad"];
            
            if (isset($_GET["aantal"]) && $_GET["aantal"] > 0) {
                $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_STRING);
                if ($aantal > $voorraad) {
                    if (is_numeric($aantal)) {
                        $overige = $aantal - $voorraad;
                    }
                    print($voorraad . " producten zijn nu op voorraad. De overige " . $overige . " zullen nabesteld worden. De levertijd zal hierdoor langer worden.<br>");
                } elseif ($aantal <= 0) {
                    print("Aantal moet meer dan 0 zijn<br>");
                } else {
                    $_SESSION["aantal"] = $aantal;
                }
                if (isset($_GET["verwijderen"])) {
                    $bedrag = null;
                    unset($winkelwagen[$naam]);
                } else {
                    if (isset($_GET["opslaan"])) {
                        $quantity = filter_input(INPUT_GET, "quantity", FILTER_SANITIZE_STRING);
                        $bedrag = $prijs * $quantity;
                        $winkelwagen[$naam] = array($quantity, $bedrag);
                    } else {
                        // Zet een product in de array $winkelwagen
                        $bedrag = $prijs * $aantal;
                        $winkelwagen[$naam] = array($aantal, $bedrag);
                    }
                }
            } else {
                print("<strong>Aantal moet meer zijn dan 0</strong><br>");
            }
            $nummer = 0;
            //Laat gegevens van het product zien: Naam, aantal, prijs
            $totaleBedrag = 0;
            print("<form method=\"GET\" action=\"winkelmandje.php\">");
            foreach ($winkelwagen as $key => $value) {
                print($key . " ");
                if (is_array($value) || $value[0] > 0) {
                    print("aantal: " . "<input type=\"text\" name=\"quantity\" value='" . $value[0] . "'>" . " Prijs: €" . $value[1] . "<button type=\"submit\" formmethod=\"GET\" name=\"verwijderen\">Verwijderen</button>");
                    print("<br>");
                }
            }
            // Berekent het totale bedrag
            foreach ($winkelwagen as $value) {
                if (is_array($value)) {
                    $totaleBedrag += $value[1];
                }
            }

            print("<br>Totale bedrag: €" . $totaleBedrag . "<br><br>");
            print('<a href="product.php?product="' . $naam . '">Terug naar productpagina</a><br>');
            print("<input type=\"submit\" value=\"Wijzigingen opslaan\" class=\"opslaanbutton\" name=\"opslaan\"></form><br>");
            if ($loggedin) {
                print("<a href=\"betalen.php\" class=\"betaalbutton\" >Naar betaalpagina</a>");
            } else {
                print("<a class=\"betaalbutton disabled\" >Naar betaalpagina</a>");
                print("<a href=\"inloggen.php\">Inloggen</a>");
            }
            if (isset($_GET["aantal"]) && $_GET["aantal"] > 0) {
            $_SESSION["bedrag"] = $bedrag;
            $_SESSION["winkelwagen"] = $winkelwagen;
            $_SESSION["totalebedrag"] = $totaleBedrag;
            }
        }
        ?>
    </div>
    <?php
    print(footer());
    ?>
</body>
</html>
