<?php
function zoeken($zoeken){
    $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    
        $search = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
        $search->execute(array("%$zoeken%"));
        $a = $search->rowCount();

    print(searchontwerp($search, $zoeken, $a));
    
}

function searchontwerp($search, $zoeken, $a){
    if($zoeken != NULL){
        foreach($search as $s) {
            $naam = $s['StockItemName']; 
            $prijs = "€" . $s['RecommendedRetailPrice']; 
            $voorraad = " Voorraad: " . $s['QuantityOnHand'] . "<br>";
            print('<div class="dip"><div class="naamproduct"><a href="product.php?product=' . ($naam) . '">' . $naam . '</a>');
            print('</div><div class="prijsproduct"><p>'.$prijs.'</p></div><div class="voorraadproduct"><p>'.$voorraad.'</p></div></div>');
        }
        print($a. " resultaten<br>");
    } else {
        if(empty($_POST) || $a == NULL){
            print("Geen resultaten");
        } else {
            print("Geen resultaten");
        }
    }
    
    $pdo = NULL;

    
}

function category(){
    print('<header>
        <div class="kop">
            <div class="logo">
                <a href="index.php"><img src="Images/WWIlogo.png"></a>
            </div>
            <nav>
                <a href="Winkelmandje.php">Winkelmandje</a>
                <a href="inloggen.php">Inloggen</a>
                <a href="contact.php">Contact</a>
            </nav>
        </div>
        </header>
        <div class="category">');
        
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        $stmt = $pdo->prepare("SELECT * FROM stockgroups");
        $stmt->execute();
        
        print("<div class=\"navbar\"><ul>");
        while($row = $stmt->fetch()){
            $category = $row["StockGroupName"];
            //$Catget = 0;
    if (ctype_space($category)) { 
        $category =preg_replace('/\s+/', '_', $category);
        print("<a href=\"$category.php\">" . $category . "</a>");
    }   else {
        print("<a href=\"$category.php\">" . $category . "</a>");
    }    
            
            //print("<a href=\"$category.php?category=\"" . ($Catget) . ">" .($category) . "</a>");
           
        }
        print("</ul></div>");
        
        $pdo = NULL;
        
        print('
        <form method="POST" action="search.php" class="zoeken">
            <input type="text" placeholder="Zoeken.." name="zoekresultaat">
            <input type="submit" placeholder="Zoeken.."value="Zoeken" name="Zoeken">
        </form>
        </div>');
}