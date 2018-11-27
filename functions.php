<?php

// De quarry voor de zoekfunctie uitvoeren, $zoeken wordt opgehaald uit de functie category.
function zoeken($zoeken) {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);

    $search = $pdo->prepare("SELECT s.StockItemName, s.RecommendedRetailPrice, h.QuantityOnHand  FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID WHERE StockItemName LIKE ?");
    $search->execute(array("%$zoeken%"));
    $a = $search->rowCount();

    print(searchontwerp($search, $zoeken, $a));
}

// De resultaten uit function zoeken weergeven, dit wordt weergegeven op naam(link naar product), prijs en voorraad
function searchontwerp($search, $zoeken, $a) {
    $zoekresultaten = trim($_POST["zoekresultaat"]);

// Als de zoekbalk leeg is wordt de pagina doorgelinkt naar http://localhost/WWI/index.php
    if (empty($zoekresultaten) || ctype_space($zoekresultaten)) {
        foreach ($search as $s) {
            $naam = $s['StockItemName'];
            $prijs = "€" . $s['RecommendedRetailPrice'];
            $voorraad = " Voorraad: " . $s['QuantityOnHand'] . "<br>";

            print('<div class="zoekenproduct"><a class="naamproduct" href="product.php?product=' . ($naam) . '">' . $naam . '</a>');
            print('<p class="prijsproduct">' . $prijs . '</p><br><br><p class="voorraadproduct">' . $voorraad . '</p></div>');
        }
    } elseif ($a == NULL) {
        print("Geen resultaten");
    } elseif ($zoeken != NULL) {
// Print naamproduct, prijs en voorraad van een product vanuit de quarry.
        print("<div class='dib'>");
        foreach ($search as $s) {
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
        print($a . " resultaten<br></div>");
    }
    $pdo = NULL;
}

// Dit is de navigatiebalk van elke pagina
function category() {
    if (isset($_SESSION["logged_in"])) {
        $loggedin = true;
        $welkombericht= ('<h1 class="welkom">Welkom, </h1>');
    } else {
        $loggedin = false;
        $welkombericht= ("");
    }
    
    print('<header>
        <div class="kop">
            <div class="logo">
                <a href="index.php"><img src="Images/WWIlogo.png"></a>
            </div>' . $welkombericht .
           '<nav>
            <a href="Winkelmandje.php">Winkelwagen</a>');


    if ($loggedin) {
        print("<a href=\"uitloggen.php\">Uitloggen</a>");
    } else {
        print("<a href=\"inloggen.php\">Inloggen</a>");
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
//$Catget = 0;
        $categorylink = preg_replace('/\s+/', '_', $category);
//print("<a href=\"$categorylink.php\">" . $category . "</a>");
        $urlsub = '<a href=Subcategorie.php?category=';
        print($urlsub . ($categorylink) . ">" . ($category) . "</a>");
        while ($row = $stmt->fetch()) {
            $category = $row["StockGroupName"];
//$Catget = 0;
            $categorylink = preg_replace('/\s+/', '_', $category);
//print("<a href=\"$categorylink.php\">" . $category . "</a>");
            $urlsub = '<a href=Subcategorie.php?category=';
            print($urlsub . ($categorylink) . ">" . ($category) . "</a>");
        }

        print("</ul></div>");

        print('<form method="POST" action="search.php" class="zoeken">');

        $pdo = NULL;

        print('<form method="POST" action="search.php" class="zoeken">
            <input type="text" placeholder="Zoeken.." name="zoekresultaat">
            <input type="submit" placeholder="Zoeken.."value="Zoeken" name="Zoeken">
            </form>
        </div>');
    }
}

//Hier word de stockitemname opgezocht met behulp van de stockitemid
function deals($deal2) {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $deal = $pdo->prepare("SELECT StockItemName FROM StockItems WHERE StockItemID LIKE ?");
    $deal->execute (array("$deal2"));
    
    while ($row = $deal->fetch()) {
        $item = $row["StockItemName"];
	print ("$item");
    }
}
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
}

function footer() {
    //print("<footer><div><a href=\"info.php\">Over Wide World Importers</a>"
      //      . "<a href=\"service.php\">Klantenservice</a><a href=\"leveranciers.php\">Leveranciers</a><a href=\"contact.php\">Contact</a></div></footer>");
}
