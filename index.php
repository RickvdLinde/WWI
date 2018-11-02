<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>World Wide Importers</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1 class="logo">World Wide Importers</h1>
        <div>
            <ul class="header">
                <li>Winkelwagen</li>
                <li><a href="inloggen.php">Inloggen</a></li>
            </ul>
        </div>
        <form method="post" action="search.php">
        Zoeken: <input type="text" name="zoekresultaat" value="">
        <input type="submit" value="Zoeken" name="Zoeken"></form>
    <?php
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        $stmt = $pdo->prepare("SELECT * FROM customercategories");
        $stmt->execute();
        
        print("<div class=\"navbar\"><ul>");
        while($row = $stmt->fetch()){
            $category = $row["CustomerCategoryName"];
            print("<li><a href=\"$category.php\">" . $category . "</a></li>");
        }
        print("</ul></div>");
        
        $pdo = NULL;
        ?>
    </body>
</html>
