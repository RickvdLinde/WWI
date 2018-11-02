<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        $a = 0;
        
        $zoeken = filter_input(INPUT_POST, "zoekresultaat", FILTER_SANITIZE_STRING);
        $search = $pdo->prepare("SELECT `StockItemName`, `RecommendedRetailPrice`  FROM `stockitems` WHERE `StockItemName` LIKE ?");
        $search->execute(array("%$zoeken%"));
        $a = $search->rowCount();
            if($zoeken != NULL){
                foreach($search as $s) {
                    $producten = ($s['StockItemName'] . (" - €") . $s['RecommendedRetailPrice'] . $s['RecommendedRetailPrice'] . ("<br>"));
                    print($producten);
                }
            print($a. " resultaten<br>");
            } elseif(empty($_POST) || $a == NULL) {
                    print("Geen resultaten");
            } else {
                print("Geen resultaten");
            }
        
        
        $pdo = NULL;
        ?>
        <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>
        <?php $producten ?>
    </body>
</html>
