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
        
        $prijs = $pdo->prepare("SELECT UnitPrice, StockGroupName FROM stockitems");
        
        $prijs->execute();
        $prod = p;
        while($row = $prijs->fetch()){
            $items = $row["StockGroupName"];
            $price = $row["UnitPrice"];
            if($prod == $items){
                print($price);
            }
        }
        ?>
    </body>
</html>