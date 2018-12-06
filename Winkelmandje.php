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
<!-- Link de styling pagina's aan de html/php pagina-->
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

        print("<h2>Shopping Cart</h2>");

        // Gegevens ophalen uit de session
        if (isset($_SESSION["naam"]) && isset($_SESSION["winkelwagen"]) && isset($_SESSION["voorraad"]) && isset($_SESSION["itemID"])) {
            $naam = $_SESSION["naam"];
            $winkelwagen = $_SESSION["winkelwagen"];
            $prijs = $_SESSION["prijs"];
            $voorraad = $_SESSION["voorraad"];
            $itemID = $_SESSION["itemID"];
            
            //aantal uit de get halen en in een session zetten
            if (isset($_GET["aantal"]) && $_GET["aantal"] > 0) {
                $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_STRING);
                if ($aantal > $voorraad) {
                    if (is_numeric($aantal)) {
                        $overige = $aantal - $voorraad;
                    }
                    // als het aantal groter is dan de voorraad
                    print($voorraad . " producten zijn nu op voorraad. De overige " . $overige . " zullen nabesteld worden. De levertijd zal hierdoor langer worden.<br>");
                } else {
                    $_SESSION["aantal"] = $aantal;
                }

                // Zet een product in de array $winkelwagen
                $id = $itemID;
                $bedrag = $prijs * $aantal;
                $winkelwagen[$itemID] = array($prijs, $aantal, $bedrag, $naam, $id);
                $productname = NULL;
            }

            // Laat gegevens van het product zien: Naam, aantal, prijs
            $totaleBedrag = 0;
            print("<br><table class=\"tabel\"><form method=\"GET\" action=\"Winkelmandje.php\"><tr><th>Product</th><th>Price per Unit</th><th></th><th>Quantity</th><th>Price</th></tr>");
            foreach ($winkelwagen as $key => $value){
                $productname = $value[4]."t";
                print("<tr><td>" . $value[3] . "</td></form>");
                print('<form methode="GET" action="#">');

                // veranderen hoeveelheid invoegveld en knop
                print('<td>€' . number_format($value[0], 2, ",", ".") . '</td><td>x</td><td><form methode="GET" action="#"><input type="text" name=' . $productname . ' placeholder=' . $value[1] . '>'
                        . '<input type="submit" class="opslaanbutton" value=' . $productname . ' ></form></td><td>€' . number_format($value[2], 2, ",", ".") . '</td>');

                // veranderd de waarde binnen de array
                    $_SESSION["aantal"] = $_GET[$productname];
                    $aantal = $productname;
                    $_SESSION["winkelwagen"[$value[1]]] = $productname;
                    print("GET : " . $_GET[$productname]);
                    print(" ProductID +t " . $productname);
                    print(" session amount : " . $_SESSION["aantal"]);
                    print(" $ aantal : " . $aantal);
                    print(" Session winkelwagen : " . $_SESSION["winkelwagen"[$value[1]]]);
                    #header("Refresh:0; url=Winkelmandje.php");
                    
                    /*(if (isset($_GET[$productname])) {
                    $_SESSION["aantal"] = $_GET[$productname];
                    $aantal = $_GET[$productname];
                    $_SESSION["winkelwagen"[$value[1]]] = $_GET[$productname];
                    print("GET : " . $_GET[$productname]);
                    print(" ProductID +t " . $productname);
                    print(" session amount : " . $_SESSION["aantal"]);
                    print(" $ aantal : " . $aantal);
                    print(" Session winkelwagen : " . $_SESSION["winkelwagen"[$value[1]]]);
                    #header("Refresh:0; url=Winkelmandje.php");
                    if ($_GET[$productname] > 0) {
                        $winkelwagen[$itemID] = array($prijs, $_GET[$productname], $bedrag, $naam, $id);
                    }
                }
                */
        
                // Delete knop 
                print('<form methode="GET" action="#"><td><input class="deletebutton" type="submit" name=' . $value[4] . ' value="Delete"></form></form>');

                if (isset($_GET[$value[4]])) {
                    unset($_SESSION["winkelwagen"][$value[4]]);
                    #header("Refresh:0; url=Winkelmandje.php");
                }
            }
        }

            print("</table>");

            // Berekent het totale bedrag
            foreach ($winkelwagen as $value) {
                if (is_array($value)) {
                    $totaleBedrag += $value[2];
                }
            }

            print("<br>Subtotal: €" . number_format($totaleBedrag, 2, ",", ".") . "<br><br>");

            //Er voor zorgen dat bezoeker ingelogd is en minimaal 1 product in zijn shopping cart heeft
            if ($loggedin && sizeof($winkelwagen) > 0) {
                print("<a href=\"betalen.php\" class=\"betaalbutton\" >Proceed to Checkout</a>");
            } elseif ($loggedin && sizeof($winkelwagen) < 1) {
                print("<a class=\"betaalbutton disabled\">Proceed to Checkout</a>");
            } else {
                print("<a href=\"inloggen.php\" class=\"betaalbutton\">Sign In</a>");
            }
            if (isset($_GET["aantal"]) && $_GET["aantal"] > 0) {
                $_SESSION["bedrag"] = $bedrag;
                $_SESSION["winkelwagen"] = $winkelwagen;
                $_SESSION["totalebedrag"] = $totaleBedrag;
            }
        #}
        ?>
</body>
</html>
