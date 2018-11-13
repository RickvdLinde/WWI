<?php
    include 'functions.php';    

    $zoeken = filter_input(INPUT_POST, "zoekresultaat", FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <?php
    zoeken($zoeken);
    
    ?>
    <a href="http://localhost/WWI/index.php">Terug naar homepagina</a>
    </body>
</html>
