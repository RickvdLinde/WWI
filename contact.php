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
        
        if($rows > 0){
            echo "<table><tr><th>Naam leverancier</th><th>Postcode</th><th>Telefoonnummer</th><th>Fax</th><th>Website</th></tr>";
            while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["SupplierName"]."</td><td>".$row["PostalCityID"]."<tr><td>".$row["PhoneNumber"]."</td><td>".$row["FaxNumber"]."<tr><td>".$row["WebsiteURL"]."";
    }
    echo "</table>";
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
