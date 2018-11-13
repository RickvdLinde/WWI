<?php
include "functions.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
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

$stmt = $pdo->prepare("SELECT * FROM stockitems SI join 
    stockitemstockgroups SISG ON SI.StockItemID=SISG.StockItemID 
    join stockgroups SG ON SISG.StockGroupID=SG.StockGroupID 
    WHERE SG.StockGroupID = 2 ORDER BY StockItemName"); 

// Uitvoeren query 
$stmt->execute();


// Resultaten verwerken namen items
while ($row = $stmt->fetch()) {

    $CitemName = $row["StockItemName"];
        //print($CitemName . "<br>");


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
            $IsAssignedAG2 = "Alien officer hoodie";
        }
        $CatAG4 = "inosaur battery-powered slippers";
        $AssignCatAG4 = stripos($CitemName,$CatAG4);
        if($AssignCatAG4) {
            $IsAssignedAG4 = "Dinosaur battery-powered slippers";
        }        
        $CatAG1 = "The Gu";
                $AssignCatAG1 = (stripos($CitemName,$CatAG1));        
                if($AssignCatAG1){
            $IsAssignedAG1 = "The Gu";
        }    
         $CatAG3 = "nimal with big feet slippers";
                $AssignCatAG3 = stripos($CitemName,$CatAG3);        
                if($AssignCatAG3){
            $IsAssignedAG3 = "Animal with big feet slippers";            
        }
        $CatAG7 = "alloween skull mask";
        $AssignCatAG7 = stripos($CitemName,$CatAG7);
        if($AssignCatAG7) {
            $IsAssignedAG7 = "Halloween skull mask";
        }
        $CatAG8 = "alloween zombie mask";
        $AssignCatAG8 = stripos($CitemName,$CatAG8);
        if($AssignCatAG8) {
            $IsAssignedAG8 = "Halloween zombie mask";
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
            $IsAssignedAG11 = "Superhero action jacket";
        }          
        //print '<img src="'.$CitemPhoto.'"style="width:128px;height:128px">';
       //print("<li><a href=\"$items.php\">" . $category . "</a></li>"'<img src="data:image/jpeg;base64,'.base64_encode( $CitemPhoto ).'"/>';
        	//print($CitemName . "<br>");
} 

?>
<?php
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

?>   
        <ul>
?>
<div class="container">
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG1);?>"><?php print($IsAssignedAG1);?></a></li>        
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG2);?>"><?php print($IsAssignedAG2);?></a></li>
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG3);?>"><?php print($IsAssignedAG3);?></a></li>        
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG4);?>"><?php print($IsAssignedAG4);?></a></li>
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG5);?>"><?php print($IsAssignedAG5);?></a></li>        
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG6);?>"><?php print($IsAssignedAG6);?></a></li>
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG7);?>"><?php print($IsAssignedAG7);?></a></li>        
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG8);?>"><?php print($IsAssignedAG8);?></a></li>
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG9);?>"><?php print($IsAssignedAG9);?></a></li>
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG10);?>"><?php print($IsAssignedAG10);?></a></li>        
        <li><a href="AGdef.php?productgroup=<?php print($IsAssignedAG11);?>"><?php print($IsAssignedAG11);?></a></li>
        </ul>   
</div>
<?php
// verbinding opruimen
$pdo = NULL;
//include "testindex.php?var=$category";

    ?>

    </body>
</html>

