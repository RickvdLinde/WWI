<?php
session_start();
if (isset($_SESSION["logged_in"])) {
    $loggedin = true;
} else {
    $loggedin = false;
}
include "functions.php";
$i = 0;
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
            $aantal = 0;
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
            }
            // Zet een product in de array $winkelwagen
            $id = $itemID;
            $bedrag = $prijs * $aantal;
          
            

            if(isset($_GET[$itemID]) && ($_GET[itemID] !== 0)) {
                $aantal = $_GET[$itemID];
                $winkelwagen[$id] = array($prijs, $aantal, $bedrag, $naam, $id);
            } else {
                $winkelwagen[$itemID] = array($prijs, $aantal, $bedrag, $naam, $id);
            }
print($_SESSION["aantal"]);
            $totaleBedrag = 0;
            $numOfProd = 0;
            print("<br><table class=\"tabel\"><tr><th>Product</th><th>Price per Unit</th><th></th><th>Quantity</th><th>Price</th></tr>");
            foreach ($winkelwagen as $key => $value) {
                $cartamoun = count($winkelwagen);
                $id = $itemID;
                $bedrag = $prijs * $aantal;
                print($cartamoun);
// Counter voor het aantal producten in de winkelmand                
                if ($i <= $cartamoun) {
                    $i = ($i + 1);
                    $a = "d" . $i;
                    print($i);
                }
                $prodBedrag = ($value[0] * $value[1]);
// veranderen hoeveelheid invoegveld en knop
                # $winkelwagen[$itemID] = array($prijs, $aantal, $bedrag, $naam, $id);
                print('<tr><td>' . $value[3] . '<td>€' . number_format($value[0], 2, ",", ".") . '</td><td>x</td><td><form methode="GET" action="#"><input type="text" name=' . $value[4] . ' placeholder=' . $aantal);

                print('><input type="submit" class="opslaanbutton" value=' . $value[4] . ' ></form>'
                        . '</td><td>€' . number_format($prodBedrag, 2, ",", ".") . '</td>');

// Delete knop 
                print('<form methode="GET" action="#"><td><input class="deletebutton" type="submit" name=' . $a . ' value=' . $a . '></form></form>');

// Het product ID uit de session gehaald waardoor deze niet in de array komt te staan vervolgens wordt de pagina opnieuw geladen
                if (isset($_GET[$a]) && $i == 1) {
                    unset($_SESSION["winkelwagen"]);
                    header("Refresh:0; url=Winkelmandje.php");
                } else {
                    if (isset($_GET[$i])) {
                        unset($_SESSION["winkelwagen"][$value[4]]);
                        header("Refresh:0; url=Winkelmandje.php");
                    }
                }
// Berekent het totale bedrag
                foreach ($winkelwagen as $value) {
                    $totaleBedrag = $totaleBedrag + $prodBedrag;
                }
            }
            print("</table>");
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
                
                $_SESSION["totalebedrag"] = $totaleBedrag;
            }
        }
    
        ?>
    </body>
</html>
