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
            $voorraad = " Voorraad: " . $s['QuantityOnHand'] . "<br>";

            print('<div class="zoekenproduct"><a class="naamproduct" href="product.php?product=' . ($naam) . '">' . $naam . '</a>');
            print('<p class="prijsproduct">' . $prijs . '</p><br><br><p class="voorraadproduct">' . $voorraad . '</p></div>');
        }
        print($a . " resultaten<br></div>");
    }
    $pdo = NULL;
}

// Dit is de navigatiebalk van elke pagina
function category() {
    if (isset($_SESSION["logged_in"])) {
        $loggedin = true;
    } else {
        $loggedin = false;
    }
    print('<header>
        <div class="kop">
            <div class="logo">
                <a href="index.php"><img src="Images/WWIlogo.png"></a>
            </div>
            <nav>
            <a href="Winkelmandje.php">Winkelwagen</a>');

    if ($loggedin) {
        print("<a href=\"inloggen.php\">Uitloggen</a>");
    } else {
        print("<a href=\"inloggen.php\">Inloggen</a>");
        print("<a href=\"registreren.php\">Registreren</a>");
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


function deals($deal2) {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);

    $deal = $pdo->prepare("SELECT StockItemName FROM StockItems WHERE StockItemID LIKE ?");
    $deal->execute(array("$deal2"));


    while ($row = $deal->fetch()) {
        $item = $row["StockItemName"];
        print ($item);
    }
    $deal = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice FROM StockItems WHERE StockItemName LIKE ?");
    $deal2 = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice FROM StockItems WHERE StockItemName LIKE ?");
    $deal3 = $pdo->prepare("SELECT StockItemName, RecommendedRetailPrice FROM StockItems WHERE StockItemName LIKE ?");
    $deal->execute();
    $deal2->execute();
    $deal3->execute();

    while ($row = $deal->fetch()) {
        $item = $row["StockItemName"];
        $prijs = $row["RecommededRetailPrice"];
        print $item;
        print (" " . $prijs);
        print("<br>");
    }
    while ($row = $deal2->fetch()) {
        $item2 = $row["StockItemName"];
        $prijs2 = $row["RecommededRetailPrice"];
        print $item2;
        print (" " . $prijs2);
        print("<br>");
    }
    while ($row = $deal3->fetch()) {
        $item3 = $row["StockItemName"];
        $prijs3 = $row["RecommededRetailPrice"];
        print $item3;
        print (" " . $prijs3);
    }
}

function photo($photo2) {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";

    while ($row = $photo->fetch()) {
        $item = $row["photo"];
        print $item;
    }
}

function footer() {
    /* print("<footer><div><a href=\"info.php\">Over Wide World Importers</a>"
      . "<a href=\"service.php\">Klantenservice</a><a href=\"leveranciers.php\">Leveranciers</a><a href=\"contact.php\">Contact</a></div></footer>"); */
}
