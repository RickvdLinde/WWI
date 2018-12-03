<?php
session_start();
if (isset($_SESSION["logged_in"])) {
    $loggedin = true;
} else {
    $loggedin = false;
}

$totaleBedrag = 0;


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

        print("<h2>Shopping Cart</h2>");

        //Gegevens ophalen uit de tabel
        if (isset($_SESSION["naam"]) && isset($_SESSION["winkelwagen"]) && isset($_SESSION["voorraad"]) && isset($_SESSION["itemID"])) {
            $naam = $_SESSION["naam"];
            $winkelwagen = $_SESSION["winkelwagen"];
            $prijs = $_SESSION["prijs"];
            $voorraad = $_SESSION["voorraad"];
            $itemID = $_SESSION["itemID"];

            // voorraad wordt gechecked
            if (isset($_GET["aantal"]) && $_GET["aantal"] > 0) {
                $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_STRING);

                // Als de voorraad kleiner is dan het gevraagde aantal geef melding        
                if ($aantal > $voorraad) {
                    if (is_numeric($aantal)) {
                        $overige = $aantal - $voorraad;
                    }
                    print($voorraad . " producten zijn nu op voorraad. De overige " . $overige . " zullen nabesteld worden. De levertijd zal hierdoor langer worden.<br>");

                    // Anders zet het gevraagde aantal in de session aantal    
                } else {
                    $_SESSION["aantal"] = $aantal;
                }

                $id = $itemID;
                $bedrag = $prijs * $aantal;
                $winkelwagen[$itemID] = array($prijs, $aantal, $bedrag, $naam, $id);
            }
            //Laat gegevens van het product zien: Naam, aantal, prijs

            print("<table class=\"tabel\"><form method=\"GET\" action=\"winkelmandje.php\"><tr><th>Product</th><th>Price per Unit</th><th></th><th>Quantity</th><th>Price</th></tr>");
            foreach ($winkelwagen as $key => $value) {
                
                print("<tr><td>" . $value[3] . "</td><td></form>");
                print("€" . number_format($value[0], 2, ",", ".") . "</td><td>x</td><td>" . 
                        "<form methode='GET' action='#'><input type=\"text\" name=\"quantity\" value='" . $value[1] . "'></td><td>" 
                        . "€" . number_format($value[2], 2, ",", ".") . '</td><td></form>');
                print('<form methode="GET" action="#">');
                print("<input type='submit' name='$value[4]' value='Delete'></form>");

                if (isset($_GET["change"])) {
                $_SESSION["aantal"][$value[1]] = $_GET["quantity"];
                #filter_input (INPUT_GET, "quantity", FILTER_SANITIZE_STRING);
                    header("Refresh:0; url=Winkelmandje.php");
                #    $bedrag = $prijs * $quantity;
                #    $winkelwagen[$naam] = array($prijs, $quantity, $bedrag);
                } 
            }

            $totaleBedrag = 0;
            print("<br><table class=\"tabel\"><form method=\"GET\" action=\"Winkelmandje.php\"><tr><th>Product</th><th>Price per Unit</th><th></th><th>Quantity</th><th>Price</th></tr>");
            foreach ($winkelwagen as $key => $value) {
                print("<tr><td>" . $value[3] . "</td></form>");
                print('<form methode="GET" action="#">');
                print('<td>€' . number_format($value[0], 2, ",", ".") . '</td><td>x</td><td>' . $value[1] . '</td><td>€' . number_format($value[2], 2, ",", ".") . '</td>');
                print("<td><input class='deletebutton' type='submit' name='$value[4]' value='Delete'></form></form>");

                if (isset($_GET[$value[4]])) {
                    unset($_SESSION["winkelwagen"][$value[4]]);
                    header("Refresh:0; url=Winkelmandje.php");
                }

            print("aantal:".$_SESSION["aantal"][$value[1]] );
                    print("GET" . $_GET["quantity"]);


            }
            print("</table>");

            // Berekent het totale bedrag
            foreach ($winkelwagen as $value) {
                if (is_array($value)) {
                    $totaleBedrag += $value[2];
                }
            }


            print("<br>Totale bedrag: €" . number_format($totaleBedrag, 2, ",", ".") . "<br><br>");

            print("<form methode ='GET' action='#'><input type=\"submit\" value=\"Save Changes\" class=\"opslaanbutton\" name=\"change\"></form><br><br>");
            if ($loggedin) {
                print("<a href=\"betalen.php\" class=\"betaalbutton\" >Naar betaalpagina</a>");


            print("<br>Subtotal: €" . number_format($totaleBedrag, 2, ",", ".") . "<br><br>");
            //print("<input type=\"submit\" value=\"Save Changes\" class=\"opslaanbutton\" name=\"opslaan\"></form><br><br>");
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
        }
        }
        ?>
    </div>
    <?php
    print(footer());
    ?>
</body>
</html>
