<?php
session_start();
include 'functions.php';
if (!isset($_SESSION['logged_in_admin'])) {
    header("location=index.php");
} else {
    print(category());
    ?>
<!DOCTYPE html>
<!-- Link de styling pagina's aan de html/php pagina-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css"> 
        <link rel="icon" href="Images/archixl-logo.png">
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>
        <form method ="POST" class='inloggen'>
            <label for='user'>StockItemID: </label><input  type='number' id='itemid' name='itemid' required><br>
            <label for='pass'>Prijs: </label><input type='text' id='prijs' name='prijs' required><br>
            <input class='updateknop' type='submit' id='submit' name='submit' value='Updaten'<br>
        </form>
    </body>
</html>
<?php
// Databaseconnectie
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $false = "";

//Gegevens ophalen uit het formulier. De letters leestekens behalve . worden eruit gehaald.
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $itemid = filter_input(INPUT_POST, 'itemid');
    $number = str_replace(['+', '-'], '', filter_var($itemid, FILTER_SANITIZE_NUMBER_INT));

//Statement voor het updaten en het checken of er een stockitem is gevonden bij dat bepaald ID.
    $stmt = $pdo->prepare("UPDATE stockitems SET RecommendedRetailPrice = '$prijs' WHERE StockItemID = '$number'");
    $check = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemID = '$itemid'");

//Als er op de knop is gedrukt.
    if (isset($_POST['submit'])) {
        $check->execute();
        $count = $check->rowCount();
        //Als er een item in de database is gevonden, voer het volgende uit.
        if ($count > 0) {
            $stmt->execute();
        } else {
            //Foutcode bij geen gevonden item.
            print('<br><div class="errormanage"><strong>Wrong format. Use numbers and for price "."</strong></div>');
        }
    }
}
?>
