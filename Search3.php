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
        
        $zoekresultaten = trim($_POST["zoekresultaat"]);
        if (empty($zoekresultaten) || ctype_space($zoekresultaten)) {
                header('Location: http://localhost/WWI/index.php');
        } elseif($zoeken != NULL){
                foreach($search as $s) {
                    $producten = ($s['StockItemName'] . (" - €") . $s['RecommendedRetailPrice'] . ("<br>"));
                    print($producten);
                }if (empty($zoekresultaten) || ctype_space($zoekresultaten)) {
                header('Location: http://localhost/WWI/index.php');
            print($a. " resultaten<br>");
            } elseif ($a === NULL) {
                    print("Geen resultaten");
            }
        }
        $pdo = NULL;
        ?>
        <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>
    </body>
</html>
