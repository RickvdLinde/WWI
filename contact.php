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
        $stmt->execute();

        while($row = $stmt->fetch()){
            $SupplierName = $row["SupplierName"];
            $PostalCityID = $row["PostalCityID"];
            $PhoneNumber = $row["PhoneNumber"];
            $FaxNumber = $row["FaxNumber"];
            $WebsiteURL = $row["WebsiteURL"];
            echo "Naam leverancier | " . $row["SupplierName"]. "<br>" . "Postcode | " . $row["PostalCityID"]. "<br>" . 
                    "Telefoonnummer | " . $row["PhoneNumber"] . "<br>" . "Fax | " . $row["FaxNumber"] . "<br>" . "Website | " . $row["WebsiteURL"] . "<br>" . "<br>";
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
            
        </p>
        
        
        
    </body>
</html>
