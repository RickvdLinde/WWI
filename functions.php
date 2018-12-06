<?php

// De quarry voor de zoekfunctie uitvoeren, $zoeken wordt opgehaald uit de functie category.
function zoeken($zoeken) {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $sort = "";


    print('<form action="#" method="GET">
            <select name="sort">
                <option value="1">Selecteer</option>
                <option value="2">Prijs laag naar hoog</option>
                <option value="3">Prijs hoog naar laag</option>
                <option value="4">Naam A tot Z</option>
                <option value="5">Naam Z tot A</option>
            </select>
            <input type="submit" name="submit" value="sort" />
        </form>');
    $_GET["test"] = $zoeken;
    if (isset($_GET['sort'])) {
        $test = $_GET["test"];
        $test = trim($test);
        print($test);
        $sort = $_GET['sort'];  // Storing Selected Value In Variable
        print ($test);
        print ($sort);

        print($test);

        switch ($sort) {
            case 1:
                $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
                $orderBy->execute(array("%$test%"));
                break;
            case 2:
                $orderBy = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ? ORDER BY RecommendedRetailPrice");
                $orderBy->execute(array("%$test%"));
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
}

// De resultaten uit function zoeken weergeven, dit wordt weergegeven op naam(link naar product), prijs en voorraad
function searchontwerp($orderBy, $zoeken, $a) {
    $zoekresultaten = trim($zoeken);
    print("<p class='zoekresultaat'> $a resultaten</p>");
    print("<div class='dib'>");
// Als de zoekbalk leeg is worden alle producten weergegeven.
    if (empty($zoekresultaten) || ctype_space($zoekresultaten)) {
        
        foreach ($orderBy as $s) {
            $naam = $s['StockItemName'];
            $prijs = "€" . $s['RecommendedRetailPrice'];
            $voorraad = $s['QuantityOnHand'];
            if ($voorraad > 0) {
                $opVoorraad = "Product is op voorraad<br>";
            } else {
                $opVoorraad = "Product is niet op voorraad<br>";
            }

            print('<div class="zoekenproduct"><a class="naamproduct" href="product.php?product=' . ($naam) . '">' . $naam . '</a>');
            print('<p class="prijsproduct">' . $prijs . '</p><br><br><p class="voorraadproduct">' . $opVoorraad . '</p></div>');
        }
    } elseif ($a == NULL) {
        print("Geen resultaten");
    } elseif ($zoeken != NULL) {
// Print naamproduct, prijs en voorraad van een product vanuit de quarry.
        
        
        foreach ($orderBy as $s) {
            $naam = $s['StockItemName'];
            $prijs = "€" . $s['RecommendedRetailPrice'];
            $voorraad = $s['QuantityOnHand'];
            if ($voorraad > 0) {
                $opVoorraad = "Product is op voorraad<br>";
            } else {
                $opVoorraad = "Product is niet op voorraad<br>";
            }

            print('<div class="zoekenproduct"><a class="naamproduct" href="product.php?product=' . ($naam) . '">' . $naam . '</a>');
            print('<p class="prijsproduct">' . $prijs . '</p><br><br><p class="voorraadproduct">' . $opVoorraad . '</p></div>');
        }

        print("</div>");
    }
    $pdo = NULL;
}

function welkom() {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    if (isset($_SESSION['logged_in'])) { // Wanneer de gebruiker ingelogd is,
        $logonname = $_SESSION['LogonName']; //hierin word de invoer van de gebruiker (emailadres) in een variable gestopt
    } else {
        $logonname = NULL; // Wanneer de gebruiker niet is ingelogd is de variable niks
    }
    $welkom = $pdo->prepare("SELECT FullName FROM people WHERE LogonName LIKE ?");
    $welkom->execute(array("$logonname"));

    while ($row = $welkom->fetch()) {
        $user = $row["FullName"];
        return ($user);
    }
}

// Dit is de navigatiebalk van elke pagina
function category() {
    $welkombericht = (""); //als hij niet ingelogd is dan gebeurd er niks.
    $loggedinadmin = false;
    if (isset($_SESSION["logged_in"])) {
        $loggedin = true;
        $welkombericht = ('<h1 class="welkom">Welcome ' . welkom() . "</h1>"); //Zodra de gebruiker ingelogd, word er een variabel gemaakt.
    } else {
        $loggedin = false;
    }
    if (!isset($_SESSION['logged_in'])) {
        if (isset($_SESSION["logged_in_admin"])) {
            $loggedinadmin = true;
            $welkombericht = ('<h1 class="welkom">Welcome ' . welkom() . "</h1>"); //Zodra de gebruiker ingelogd, word er een variabel gemaakt.
        } else {
            $loggedinadmin = false;
        }
    }
    print('<header>
        <div class="kop">
            <div class="logo">
                <a href="index.php"><img src="Images/WWIlogo.png"></a>
            </div>' . $welkombericht .
            '<nav>
            <a href="Winkelmandje.php">Shopping Cart</a>');

    if ($loggedinadmin) {
        print("<a href=\"manage.php\">Manage</a>");
        print("<a href=\"uitloggen.php\">Sign Out</a>");
    }
    if ($loggedin) {
        print("<a href=\"uitloggen.php\">Sign Out</a>");
    }
    if (empty($_SESSION['logged_in']) && empty($_SESSION['logged_in_admin'])) {
        print("<a href=\"inloggen.php\">Sign In</a>");
    }
    print('</nav>
            </div>
        </header>
        <div class="category">');
    $pdo = NULL;
    $pdo = NULL;
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);

    $stmt = $pdo->prepare("SELECT * FROM stockgroups");
    $stmt->execute();

    print("<div class=\"navbar\"><ul>");
    while ($row = $stmt->fetch()) {
        $category = $row["StockGroupName"];
        $categorylink = preg_replace('/\s+/', '_', $category);
        $urlsub = '<a href=Subcategorie.php?category=';
        print($urlsub . ($categorylink) . ">" . ($category) . "</a>");
        while ($row = $stmt->fetch()) {
            $category = $row["StockGroupName"];
            $categorylink = preg_replace('/\s+/', '_', $category);
            $urlsub = '<a href=Subcategorie.php?category=';
            print($urlsub . ($categorylink) . ">" . ($category) . "</a>");
        }

        print("</ul></div>");


        $pdo = NULL;

        print('<form method="GET" action="search.php" class="zoeken">
            <input type="text" placeholder="Search.." name="zoekresultaat" maxlenght="50">
            <input type="submit" placeholder="Zoeken.."value="Search" name="Zoeken">
            </form>
        </div>');
    }
}

//Hier word de stockitemname opgezocht met behulp van de stockitemid
function recommend($recom2) {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $recom = $pdo->prepare("SELECT StockItemName FROM StockItems WHERE StockItemID LIKE ?");
    $recom->execute(array("$recom2"));

    while ($row = $recom->fetch()) {
        $item = $row["StockItemName"];
        print ("$item");
    }
}

function price($price2) {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $price = $pdo->prepare("SELECT RecommendedRetailPrice FROM StockItems WHERE StockItemID LIKE ?");
    $price->execute(array("$price2"));

    while ($row = $price->fetch()) {
        $price3 = $row["RecommendedRetailPrice"];
        print (" €" . "$price3");
    }
}

/* Dit is een functie als je de afbeelding uit de database haalt.
//Hier word foto uit de database gehaald die hij vergelijkt met de stockitemid
function photo($photo2){
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $photo = $pdo->prepare("SELECT photo FROM StockItems WHERE StockItemID LIKE ?");
    $photo->execute (array("$photo2"));
    
    // Vervolgens word de blob omgezet naar een werkelijke afbeelding
     while ($row = $photo->fetch()) {
        $item = $row["photo"];
        print ("data:image/png;base64," . base64_encode($item));
        
     }
}*/

/*function footer() {
    print("<footer><div><a href=\"info.php\">About Wide World Importers</a>"
            . "<a href=\"service.php\">Customer support</a><a href=\"leveranciers.php\">Suppliers</a><a href=\"contact.php\">Contact</a></div></footer>");
}*/
