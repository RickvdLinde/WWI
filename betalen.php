<?php
include "functions.php";
session_start();
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
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);

        $betalen = $pdo->prepare("SELECT PaymentMethodName FROM paymentmethods");
        $bezorgen = $pdo->prepare("SELECT DeliveryMethodName FROM deliverymethods");
        $betalen->execute();
        $bezorgen->execute();

        //controle of klant ingelogd is en of er minimaal 1 product in de winkelwagen zit
        if (!empty($_SESSION["winkelwagen"]) && !empty($_SESSION['logged_in'])) {
            $winkelwagen = $_SESSION["winkelwagen"];

            //Wanneer winkelwagen leeg is niks weergeven
            if (!empty($winkelwagen)) {
                print("<div class=\"borderpagina\">");
                print("Total price: €");
                if (isset($_SESSION["totalebedrag"])) {
                    $totaleBedrag = $_SESSION["totalebedrag"];
                    print(number_format($totaleBedrag, 2, ",", "."));
                }
                
                //select voor betaalmethode
                $betaalarray = array();
                $betaalkey = 0;
                print("<br><br><form method=\"GET\ action=\"#\">");
                print("Payment method: <select name=\"betaalmethode\"><option>Select Paymentmethod</option>");
                while ($row = $betalen->fetch()) {
                    $Betaalmethode = $row["PaymentMethodName"];
                    print("<option>" . $Betaalmethode . "</option>");
                    $betaalarray[$betaalkey] = $Betaalmethode;
                    $betaalkey++;
                }
                print("</select><br><br>");

                //select voor bezorgmethode
                $bezorgarray = array();
                $bezorgkey = 0;
                print("Delivery method: <select name=\"bezorgmethode\"><option>Select Deliverymethod</option>");
                while ($row = $bezorgen->fetch()) {
                    $Bezorgmethode = $row["DeliveryMethodName"];
                    print("<option>" . $Bezorgmethode . "</option>");
                    $bezorgarray[$bezorgkey] = $Bezorgmethode;
                    $bezorgkey++;
                }
                print("</select><br><br>");
                print("<input class=\"betaalbutton\" type=\"submit\" name=\"submit\" value=\"Confirm\"<br><br><br>");
            }

            //kijkt of mensen een bezorg- en betaalmethode gekozen hebben
            if (isset($_GET["submit"])) {
                if (in_array($_GET['betaalmethode'], $betaalarray) && in_array($_GET['bezorgmethode'], $bezorgarray)) {
                    print("</form><br>Payment processed<br><br><a class='betaalbutton' href=\"index.php\">Return to homepage</a>");
                    unset($_SESSION['winkelwagen']);
                } else {
                    print("<strong>Select payment method and delivery method</strong>");
                }
            }
        }
        print("</div>");
        ?>
    </body>
</html>
