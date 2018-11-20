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
        
        if(isset($_SESSION["winkelwagen"])){
            $winkelwagen = $_SESSION["winkelwagen"];
        }
        
        if (!empty($winkelwagen)){
        print("<div class=\"borderpagina\">");
        print("Totale bedrag: €");
        if (isset($_SESSION["totalebedrag"])) {
            $totaleBedrag = $_SESSION["totalebedrag"];
            print($totaleBedrag);
        }
        
        print("<br><br><form method=\"GET\ action=\"#\">");
        //select voor betaalmethode
        print("Betaalmethode: <select>");
        while ($row = $betalen->fetch()) {
            $Betaalmethode = $row["PaymentMethodName"];
            print("<option>" . $Betaalmethode . "</option>");
        }
        print("</select><br><br>");

        //select voor bezorgmethode
        print("Bezorgmethode: <select>");
        while ($row = $bezorgen->fetch()) {
            $Bezorgmethode = $row["DeliveryMethodName"];
            print("<option>" . $Bezorgmethode . "</option>");
        }
        print("</select><br><br>");
        print("<input class=\"betaalbutton\" type=\"submit\" name=\"submit\" value=\"Betalen\"<br>");
        }
        if (isset($_GET["submit"])) {
            print("</form><br>Betaling is verwerkt<br><a href=\"index.php\">Ga terug naar beginpagina</a>");
            unset($_SESSION['winkelwagen']);
        }
        print("</div>");
        
        ?>
        <?php
        print(footer());
        ?>
    </body>
</html>
