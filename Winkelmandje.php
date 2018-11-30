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

        print("<h2>Shopping Cart</h2>");

        //Gegevens ophalen uit de tabel
        if (isset($_SESSION["naam"]) && isset($_SESSION["winkelwagen"]) && isset($_SESSION["voorraad"]) && isset($_SESSION["itemID"])) {
            $naam = $_SESSION["naam"];
            $winkelwagen = $_SESSION["winkelwagen"];
            $prijs = $_SESSION["prijs"];
            $voorraad = $_SESSION["voorraad"];
            $itemID = $_SESSION["itemID"];

            if (isset($_GET["aantal"]) && $_GET["aantal"] > 0) {
                $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_STRING);
                if ($aantal > $voorraad) {
                    if (is_numeric($aantal)) {
                        $overige = $aantal - $voorraad;
                    }
                    print($voorraad . " producten zijn nu op voorraad. De overige " . $overige . " zullen nabesteld worden. De levertijd zal hierdoor langer worden.<br>");
                } else {
                    $_SESSION["aantal"] = $aantal;
                }
                /* if (isset($_GET["opslaan"])) {
                  $quantity = filter_input(INPUT_GET, "quantity", FILTER_SANITIZE_STRING);
                  $bedrag = $prijs * $quantity;
                  $winkelwagen[$naam] = array($prijs, $quantity, $bedrag);
                  } else { */
                // Zet een product in de array $winkelwagen

                $id = $itemID;
                $bedrag = $prijs * $aantal;
                $winkelwagen[$itemID] = array($prijs, $aantal, $bedrag, $naam, $id);

                //}
            }
            $nummer = 0;
            //Laat gegevens van het product zien: Naam, aantal, prijs
            $totaleBedrag = 0;
            print("<table class=\"tabel\"><form method=\"GET\" action=\"Winkelmandje.php\"><tr><th>Product</th><th>Price per Unit</th><th></th><th>Quantity</th><th>Price</th></tr>");
            foreach ($winkelwagen as $key => $value) {
                print("<tr><td>" . $value[3] . "</td><td>");
                if (is_array($value) || $value[0] > 0) {
                    print("€" . number_format($value[0], 2, ",", ".") . "</td><td>x</td><td>" . $value[1] . "</td><td>" . "€" . number_format($value[2], 2, ",", ".") . '</td><td>');
                    print('<input name="index_to_remove" type="hidden" value=' . $value[4] . '>');
                    print('<input class="deletebutton" type="submit" value="' . $value[4] . '" name="verwijderen"></td></tr><br>');
                    if (isset($_GET["index_to_remove"]) && $_GET["index_to_remove"] != "") {
                        if ($_GET[$value[4]] == $_GET["index_to_remove"]) {
                            $key_to_delete = $_GET[$value[4]];
                            unset($_SESSION["winkelwagen"][$key_to_delete]);
                            //header("Refresh:0; url=Winkelmandje.php");
                            $nummer++;
                        }
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

            print("<br>Totale bedrag: €" . number_format($totaleBedrag, 2, ",", ".") . "<br><br>");
            print("<a href=\"javascript:history.go(-2)\">Terug naar productpagina</a>");
            print("<input type=\"submit\" value=\"Save Changes\" class=\"opslaanbutton\" name=\"opslaan\"></form><br><br>");
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
