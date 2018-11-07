<?php
include "functions.php"
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
        
        $aantal = filter_input(INPUT_GET, "aantal", FILTER_SANITIZE_NUMBER_FLOAT);
        if($aantal > 0){
            print($aantal);
        }
        ?>
    </body>
</html>
