<?php
include "functions.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
        <link rel="icon" href="Images/archixl-logo.png">
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>

        <?php
        print(category());

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
            //print($CitemName . "<br>");
            //print substr_compare($itemnames[$key], $itemnames[$key] - 1, 0, 3);
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
            $UniqueCats = array_unique($DuplicateCats);
        }
//print_r($arraydups);
        $urlproduct1 = '<a href=product.php?product=';
        $urlproduct2 = '<a href=product2.php?product=';
//$productlink = preg_replace('/\s+/', '_', $loneproducts);
        $usedproducts = array();
        if (count($DuplicateCats) > 0) {
            foreach ($arraydups as $cats => $counts) {

                $productlink = preg_replace('/\s+/', '_', $cats);
                print($urlproduct1 . ($productlink) . ">" . ($cats) . "</a>");
                print("<br>");
            }
        }
        //print($cats);
        /*    if($counts > 1){
          $productlink = preg_replace('/\s+/', '_', $cats);
          print($urlproduct2 . ($productlink) . ">" .($cats) . "</a>");
          } else {
          foreach ($loneproducts as $a) {
          if($a == $cats){
          $productlink = preg_replace('/\s+/', '_', $a);
          print($urlproduct1 . ($productlink) . ">" .($a) . "</a>");

          }
          }
          if ($counts = 1 && $a != $cats){
          print("test");
          }
          }
          print("<br>");
          }
          } else {
          print("Geen resultaten");
          } */
        $pdo = NULL;
        print(footer());
        ?>
</html>
