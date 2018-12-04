<?php
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
        ?>
        
        <h1 class="borderpagina">
            Contact information suppliers 
        </h1>
        
        <p class="te borderpagina">

        <?php

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
            echo "Supplier name | " . $row["SupplierName"]. "<br>" . "Postal code | " . $row["PostalCityID"]. "<br>" . 
                    "Phone number | " . $row["PhoneNumber"] . "<br>" . "Fax | " . $row["FaxNumber"] . "<br>" . "Website | " . $row["WebsiteURL"] . "<br>" . "<br>";
        }
        ?>
        </p>
    </body>
</html>
