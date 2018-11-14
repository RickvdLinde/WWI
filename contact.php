<?php
include "functions.php"
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>World Wide Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
    </head>
    <body class="bodi">
        <?php
        
        print(category());
        
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        $stmt = $pdo->prepare("SELECT SupplierName, PostalCityID, PhoneNumber, FaxNumber, WebsiteURL FROM suppliers");
        $result = $stmt->execute();
        $rows = $stmt->fetchAll(); // assuming $result == true
        $n = count($rows);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "Naam leverancier | " . $row["SupplierName"] . "<br>" . "Postcode | " . $row["PostalCityID"] . 
                        "Telefoonnummer | " . $row["PhoneNumber"] . "<br>" . "Fax | " . $row["FaxNumber"]. "Website | " . $row["WebsiteURL"] . "<br>";
            }
        } else {
            echo "0 results";
        }

        
        
        
        ?>
        <h1 class="text">
            Contactgegevens leveranciers
        </h1>
        
        <p class="tk border">
            E-mail: worldwideimporters@world.nl
            <br/>
            Telefoonnummer: 0646634533
            <br/>
            Locatie: Zwolle
        </p>
        
        
        
    </body>
</html>
