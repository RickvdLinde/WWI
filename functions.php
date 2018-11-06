<?php
function zoeken($zoeken){
    $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    
        $search = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
        $search->execute(array("%$zoeken%"));
        $a = $search->rowCount();

            if($zoeken != NULL){
                foreach($search as $s) {
                    $producten = ($s['StockItemName'] . (" - €") . $s['RecommendedRetailPrice'] . " Voorraad: " . $s['QuantityOnHand'] . "<br>");
                    print($producten);
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
                <a>Winkelwagen</a>
                <a href="inloggen.php">Inloggen</a>
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
        
        print("<div class=\"navbar hover\"><ul>");
        while($row = $stmt->fetch()){
            $category = $row["StockGroupName"];
            print("<a href=\"$category.php\">" . $category . "</a>");
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