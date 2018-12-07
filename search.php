<?php
include 'functions.php';
session_start();


$db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
$user = "root";
$pass = "";
$pdo = new PDO($db, $user, $pass);
$zoeken = filter_input(INPUT_GET, "zoekresultaat", FILTER_SANITIZE_STRING);
$_SESSION['zoekenvalue'] = $zoeken;
?>
<!DOCTYPE html>
<!-- Link de styling pagina's aan de html/php pagina-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="icon" href="Images/archixl-logo.png">
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>
        <?php
        print(category());

        print('<form action="search.php" method="GET" class="filter">
            <select name="sort">
                <option value="1">Select</option>
                <option value="2">Price: low to high</option>
                <option value="3">Price: high to low</option>
                <option value="4">Name: A to Z</option>
                <option value="5">Name: Z to A</option>
            </select>
            <input type="submit" name="submit" value="sort" />
        </form>');
        
       
        if (isset($_GET['sort'])) {
            //print $zoeken;
            //$test = $_GET["test"];
            //$test = trim($test);
            $sort = $_GET['sort'];  // Storing Selected Value In Variable
            //print ($test);
            print ($sort);
            //$_SESSION['zoekenvalue'] = trim($_SESSION['zoekenvalue']);
            //print($_SESSION['zoekenvalue']);

            switch ($sort) {
                case 1:
                    $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
                    $a = $_SESSION['zoekenvalue'];
                    $orderBy->execute(array("%{$a}%"));
                    break;
                case 2:
                    $a = $_SESSION['zoekenvalue'];
                    $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ? ORDER BY RecommendedRetailPrice");
                    $orderBy->execute(array("%{$a}%"));
                    break;
                case 3:
                    $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ? ORDER BY RecommendedRetailPrice DESC");
                    $orderBy->execute(array("%$test%"));
                    break;
                case 4:
                    $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ? ORDER BY StockItemName");
                    $orderBy->execute(array("%$test%"));
                    break;
                case 5:
                    $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ? ORDER BY StockItemName DESC");
                    $orderBy->execute(array("%$test%"));
                    break;
            }
        }

        if (!isset($_GET['submit'])) {
            $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
            $orderBy->execute(array("%$zoeken%"));
        }
        $a = $orderBy->rowCount();
        print(searchontwerp($orderBy, $zoeken, $a));
        ?>
        <a href="http://localhost/WWI/index.php">Return to homepage</a>

    </body>
</html>