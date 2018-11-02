<?php
include "Testindex.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        
        print(Test());
        // Verbinding maken database
        $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        // voorbereiden query selecteren items van een categorie

$stmt = $pdo->prepare("select * from stockitems SI join 
    stockitemstockgroups SISG on SI.StockItemID=SISG.StockItemID 
    join stockgroups SG on SISG.StockGroupID=SG.StockGroupID 
    where SG.StockGroupID = 2 order by StockItemName"); //cijfer moet eigenlijk naar tekst

// Uitvoeren query //180tm225 stockitemID
$stmt->execute();


// Resultaten verwerken namen items
while ($row = $stmt->fetch()) {

	$CitemName = $row["StockItemName"];
        $CitemPhoto = $row["Photo"];
        print($CitemName . "<br>");
 
         $CatThe_GU = "The Gu";
                $AssignCatThe_Gu = stripos($CitemName,$CatThe_GU);        
                if($AssignCatThe_Gu){
            $IsAssignedThe_GU = "The Gu T-Shirts";
        }    
         $CatAnimal = "animal";
                $AssignCatAnimal = stripos($CitemName,$CatAnimal);        
                if($AssignCatAnimal){
            $IsAssignedAnimal = "Animals";            
        }
         $alien = "alien officer";
                $AssignCatAOH = stripos($CitemName,$alien);        
                if(1==1){
            $IsAssignedAOH = "Alien";            
        }    
        //print '<img src="'.$CitemPhoto.'"style="width:128px;height:128px">';
       //print("<li><a href=\"$items.php\">" . $category . "</a></li>"'<img src="data:image/jpeg;base64,'.base64_encode( $CitemPhoto ).'"/>';
        	//print($CitemName . "<br>");
} 
print("<li><a href=\"$IsAssignedAOH.php\">" . $IsAssignedAOH. "</a></li>");  
print("<li><a href=\"$IsAssignedThe_GU.php\">" . $IsAssignedThe_GU . "</a></li>");
print("<li><a href=\"$IsAssignedAnimal.php\">" . $IsAssignedAnimal . "</a></li>");  
// verbinding opruimen
$pdo = NULL;
//include "testindex.php?var=$category";
        ?>
    </body>
</html>

