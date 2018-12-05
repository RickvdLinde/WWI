<?php
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
    </head>
    <body>
        
        <?php
        
        print(category());
        // Verbinding maken database
        $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        // voorbereiden query selecteren items van een categorie

$stmt = $pdo->prepare("select * from stockitems SI join 
    stockitemstockgroups SISG on SI.StockItemID=SISG.StockItemID 
    join stockgroups SG on SISG.StockGroupID=SG.StockGroupID 
    where SG.StockGroupID = 1 order by StockItemName"); 

// Uitvoeren query 
$stmt->execute();


// Resultaten verwerken namen items
while ($row = $stmt->fetch()) {

	$CitemName = $row["StockItemName"];
        print($CitemName . "<br>");


        $CatAG5 = "urry animal socks";
                $AssignCatAG5 = (stripos($CitemName,$CatAG5));        
                if($AssignCatAG5){
            $IsAssignedAG5 = "Furry animal socks";
        }    
         $CatAG6 = "urry gorilla with big eyes slippers";
                $AssignCatAG6 = stripos($CitemName,$CatAG6);        
                if($AssignCatAG6){
            $IsAssignedAG6 = "Furry gorilla with big eyes slippers";            
        }
        $CatAG2 = "lien officer hoodie";
        $AssignCatAG2 = stripos($CitemName,$CatAG2);
        if($AssignCatAG2) {
            $IsAssignedAG2 = "Aliën officer hoodies";
        }
        $CatAG4 = "inosaur battery-powered slippers";
        $AssignCatAG4 = stripos($CitemName,$CatAG4);
        if($AssignCatAG4) {
            $IsAssignedAG4 = "Dinosaur battery-powered slippers";
        }        
        $CatAG1 = "The Gu";
                $AssignCatAG1 = (stripos($CitemName,$CatAG1));        
                if($AssignCatAG1){
            $IsAssignedAG1 = "The Gu T-Shirts";
        }    
         $CatAG3 = "nimal with big feet slippers";
                $AssignCatAG3 = stripos($CitemName,$CatAG3);        
                if($AssignCatAG3){
            $IsAssignedAG3 = "Animal with big feet slippers";            
        }
        $CatAG7 = "alloween skull mask";
        $AssignCatAG7 = stripos($CitemName,$CatAG7);
        if($AssignCatAG7) {
            $IsAssignedAG7 = "Halloween skull masks";
        }
        $CatAG8 = "alloween zombie mask";
        $AssignCatAG8 = stripos($CitemName,$CatAG8);
        if($AssignCatAG8) {
            $IsAssignedAG8 = "Halloween zombie masks";
        } 
         $CatAG9 = "gre battery-powered slippers";
                $AssignCatAG9 = stripos($CitemName,$CatAG9);        
                if($AssignCatAG9){
            $IsAssignedAG9 = "Ogre battery-powered slippers";            
        }
        $CatAG10 = "lush shark slippers";
        $AssignCatAG10 = stripos($CitemName,$CatAG10);
        if($AssignCatAG10) {
            $IsAssignedAG10 = "Plush shark slippers";
        }
        $CatAG11 = "uperhero action jacket";
        $AssignCatAG11 = stripos($CitemName,$CatAG11);
        if($AssignCatAG11) {
            $IsAssignedAG11 = "Superhero action jacket (Blue) 3XL";
        }          
        //print '<img src="'.$CitemPhoto.'"style="width:128px;height:128px">';
       //print("<li><a href=\"$items.php\">" . $category . "</a></li>"'<img src="data:image/jpeg;base64,'.base64_encode( $CitemPhoto ).'"/>';
        	//print($CitemName . "<br>");
} 
print("<li><a href=\"$IsAssignedAG1.php\">" . $IsAssignedAG1. "</a></li>");  
print("<li><a href=\"$IsAssignedAG2.php\">" . $IsAssignedAG2. "</a></li>");  
print("<li><a href=\"$IsAssignedAG3.php\">" . $IsAssignedAG3. "</a></li>");  
print("<li><a href=\"$IsAssignedAG4.php\">" . $IsAssignedAG4. "</a></li>");
print("<li><a href=\"$IsAssignedAG5.php\">" . $IsAssignedAG5. "</a></li>");  
print("<li><a href=\"$IsAssignedAG6.php\">" . $IsAssignedAG6. "</a></li>");  
print("<li><a href=\"$IsAssignedAG7.php\">" . $IsAssignedAG7. "</a></li>");  
print("<li><a href=\"$IsAssignedAG8.php\">" . $IsAssignedAG8. "</a></li>");
print("<li><a href=\"$IsAssignedAG9.php\">" . $IsAssignedAG9. "</a></li>");  
print("<li><a href=\"$IsAssignedAG10.php\">" . $IsAssignedAG10. "</a></li>");  
print("<li><a href=\"$IsAssignedAG11.php\">" . $IsAssignedAG11. "</a></li>");
print("<form action=\"/AGdef.php\" method=\"post\" target=\"_blank\"><br>
        <a href=\"$IsAssignedAG11.php\">" . $IsAssignedAG11. "</a></form>");


// verbinding opruimen
$pdo = NULL;
//include "testindex.php?var=$category";
        ?>
        
<a href="AGdef.php?productgroup=<?php print($IsAssignedAG11);?>"><?php print($IsAssignedAG11);?></a>
    </body>
</html>