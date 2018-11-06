<?php
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        
     
        // Verbinding maken database
        $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        // voorbereiden query selecteren items van een categorie

$stmt = $pdo->prepare("select SI.StockItemID, SI.StockItemName from stockitems SI join 
    stockitemstockgroups SISG on SI.StockItemID=SISG.StockItemID 
    join stockgroups SG on SISG.StockGroupID=SG.StockGroupID 
    where SI.StockItemID > 179 AND SI.StockitemID < 226"); //cijfer moet eigenlijk naar tekst

// Uitvoeren query //180tm225 stockitemID
$stmt->execute();


// Resultaten verwerken namen items
while ($row = $stmt->fetch()) {

	$CitemName = $row["StockItemName"];
        $CitemID = $row["StockItemID"];
        print($CitemID . " ");
	print($CitemName . "<br>");
        //print '<img src="'.$catnaam.'"style="width:128px;height:128px">';
        //print '<img src="data:image/jpeg;base64,'.base64_encode( $catnaam ).'"/>';
}
// verbinding opruimen
$pdo = NULL;
//include "testindex.php?var=$category";
        ?>
    </body>
</html>