<?php
session_start();
include "functions.php";
?>
<!DOCTYPE html>
<!-- Link de styling pagina's aan de html/php pagina-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
        <link rel="icon" href="Images/archixl-logo.png">
        <link rel="stylesheet" type="text/css" href="style2.css">
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
    </head>
    <body>

        <?php
        print(category());
//categorienaam uit GET halen
        $Subcat2 = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);

        $Subcat2 = preg_replace('/_/', ' ', $Subcat2);


        // Verbinding maken database
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);

        // voorbereiden query selecteren items van een categorie

        $stmt = $pdo->prepare("select * from stockitems SI join 
    stockitemstockgroups SISG on SI.StockItemID=SISG.StockItemID 
    join stockgroups SG on SISG.StockGroupID=SG.StockGroupID 
    WHERE SG.StockGroupName = ? 
    ORDER BY StockItemName");

// Uitvoeren query 
        $stmt->execute(array($Subcat2));


// Resultaten verwerken namen items
        $key = 0;
        $key2 = 0;
        $DuplicateCats = array();
        $loneproducts = array();
        $itemsubcats = 0;

        while ($row = $stmt->fetch()) {


            $CitemName = $row["StockItemName"];
            $loneproducts[$key2] = $CitemName;
            $key2++;
            //bepalen hoe de namen van de subcategorie eruit zien.
            $HasUnderscore = strpos($CitemName, " - ");
            $HasColorassignment = strpos($CitemName, "(");
            if ($HasUnderscore) {
                $itemsubcats = strstr($CitemName, "- ", TRUE);
            } elseif ($HasUnderscore == FALSE && $HasColorassignment == TRUE) {
                $itemsubcats = strstr($CitemName, "(", TRUE);
            } else {
                $itemsubcats = $CitemName;
                
            }

            $DuplicateCats[$key] = $itemsubcats;
            $key++;
            $arraydups = array_count_values($DuplicateCats);
        }
// link naar productpagina
        $urlproduct1 = '<a href=product.php?product=';
        $urlproduct2 = '<a href=product2.php?product=';
//weergave van de subcategorieen
if (count($DuplicateCats) > 0){
print("<div class=\"wrapper\">");
    foreach ($arraydups as $cats => $counts) {
    
            $productlink = preg_replace('/\s/', '_', $cats);
            print("<div class=\"grid\">" . $urlproduct1 . ($productlink) . "><div class='productview'>" .($cats) . "</div></a><br><div class'productlink'>" . $counts . " Option(s)</div></div>");
}
print("</div>");
    } else {
        print("No results available");
    }
        $pdo = NULL;
        ?>
</html>
