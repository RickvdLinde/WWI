<?php
include "functions.php";
session_start();
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
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);

        $betalen = $pdo->prepare("SELECT PaymentMethodName FROM paymentmethods");
        $bezorgen = $pdo->prepare("SELECT DeliveryMethodName FROM deliverymethods");
        $betalen->execute();
        $bezorgen->execute();

        if (!empty($_SESSION["winkelwagen"])) {
            $winkelwagen = $_SESSION["winkelwagen"];


            if (!empty($winkelwagen)) {
                print("<div class=\"borderpagina\">");
                print("Totale bedrag: €");
                if (isset($_SESSION["totalebedrag"])) {
                    $totaleBedrag = $_SESSION["totalebedrag"];
                    print(number_format($totaleBedrag, 2, ",", "."));
                }

                //select voor betaalmethode
                print("<br><br><form method=\"GET\ action=\"#\">");
                print("Betaalmethode: <select name=\"betaalmethode\"><option>Selecteer betaalmethode</option>");
                while ($row = $betalen->fetch()) {
                    $Betaalmethode = $row["PaymentMethodName"];
                    print("<option>" . $Betaalmethode . "</option>");
                }
                print("</select><br><br>");

                //select voor bezorgmethode
                print("Bezorgmethode: <select name=\"bezorgmethode\"><option>Selecteer bezorgmethode</option>");
                while ($row = $bezorgen->fetch()) {
                    $Bezorgmethode = $row["DeliveryMethodName"];
                    print("<option>" . $Bezorgmethode . "</option>");
                }
                print("</select><br><br>");
                print("<input class=\"betaalbutton\" type=\"submit\" name=\"submit\" value=\"Betalen\"<br><br><br>");
            }

            //kijkt of mensen een bezorg- en betaalmethode gekozen hebben
            if (isset($_GET["submit"])) {
                if ($_GET['betaalmethode'] !== "Selecteer betaalmethode" && $_GET['bezorgmethode'] !== "Selecteer bezorgmethode") {
                    print("</form><br>Betaling is verwerkt<br><br><a class='betaalbutton' href=\"index.php\">Ga terug naar beginpagina</a>");
                    unset($_SESSION['winkelwagen']);
                } else {
                    print("<strong>Selecteer een betaalmethode en een bezorgmethode</strong>");
                }
            }
            
        }
        print("</div>");
        ?>
        <?php
        print(footer());
        ?>
    </body>
</html>
