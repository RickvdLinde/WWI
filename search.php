<?php
include 'functions.php';


    $zoeken = filter_input(INPUT_GET, "zoekresultaat", FILTER_SANITIZE_STRING);
    
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);

session_start();
$zoeken = filter_input(INPUT_GET, "zoekresultaat", FILTER_SANITIZE_STRING);

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
        print(zoeken($zoeken));
        ?>
        <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>

    </body>
</html>