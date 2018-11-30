<?php
session_start();

include "functions.php"
?>
<!DOCTYPE html>
                
        <?php
        print(category());
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);      
        $naam = filter_input(INPUT_GET,
        "product", FILTER_SANITIZE_STRING);
        
                $naam = preg_replace('/_/', ' ', $naam);
        
        $stmt = $pdo->prepare("SELECT s.StockItemID, StockItemName, RecommendedRetailPrice, QuantityOnHand, MarketingComments, SupplierName FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID JOIN suppliers l
        ON s.SupplierID = l.SupplierID WHERE StockItemName LIKE ?");

        $stmt->execute(array("%$naam%"));

        while ($row = $stmt->fetch()) {
            
            $itemID = $row["StockItemID"];
            $name = $row["StockItemName"];
            $prijs = $row["RecommendedRetailPrice"];
            $voorraad = $row["QuantityOnHand"];
            $comment = $row["MarketingComments"];
            $leverancier = $row["SupplierName"];
            ?>
                    
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Wide World Importers</title>
                    <link rel="icon" href="Images/archixl-logo.png">
                    <link rel="stylesheet" type="text/css" href="Mainstyle.css">
                    <link rel="stylesheet" type="text/css" href="style2.css">
                </head>
                <body class="bodi">

                <div class="slider-holder">
                    <span id="slider-image-1"></span>
                    <span id="slider-image-2"></span>
                    <span id="slider-image-3"></span>
                    <div class="image-holder">
                        <img src="Images/1.jpg" class="slider-image" />
                        <img src="Images/2.png" class="slider-image" />
                        <img src="Images/3.jpg" class="slider-image" />
                    </div>
                    <div class="button-holder">
                        <a href="#slider-image-1" class="slider-change"></a>
                        <a href="#slider-image-2" class="slider-change"></a>
                        <a href="#slider-image-3" class="slider-change"></a>
                    </div>
                </div>        
        
                    <?php
                    print("<div class='productnaamprijs'><div class=\"productnaam\">" . $name . "</div>");
                    print("<div class=\"productprijs\">€" . $prijs) . "</div></div>";
                    if ($voorraad > 0) {
                        print('<div class="productopvoorraad">Product is op voorraad</div>');
                    } else {
                        print('<div class="productnietvoorraad">Product is niet op voorraad</div>');
                    }
                    ?>
                    <div class="formaantal">
                        <form method="get" action=Winkelmandje.php>
                            <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" name="aantal">
                            <input class="toevoegenbutton" type="submit" name="submit" value="Toevoegen aan Winkelmandje">
                        </form>
                    </div>
                    <?php print("<br><br><a href=\"leveranciers.php\" class=\"productleverancier\">Leverancier: " . $leverancier) . "</a>"; ?>
                </div>

            <head>
            <meta charset="UTF-8">
            <title>Wide World Importers</title>
            <link rel="icon" href="Images/archixl-logo.png">
            <link rel="stylesheet" type="text/css" href="Mainstyle.css">
            <link rel="stylesheet" type="text/css" href="style2.css">
            </head>
            <body>

            <div class="slideshow-container">

            <div class="mySlides fade">
                <img src="Images/1.png">
            </div>

            <div class="mySlides fade">
                <img src="Images/2.png">
            </div>

            <div class="mySlides fade"> 
                <img src="Images/3.png">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
            <br>

            <div style="text-align:center">
              <span class="dot" onclick="currentSlide(1)"></span> 
              <span class="dot" onclick="currentSlide(2)"></span> 
              <span class="dot" onclick="currentSlide(3)"></span> 
            </div>

            <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
              showSlides(slideIndex += n);
            }

            function currentSlide(n) {
              showSlides(slideIndex = n);
            }

            function showSlides(n) {
              var i;
              var slides = document.getElementsByClassName("mySlides");
              var dots = document.getElementsByClassName("dot");
              if (n > slides.length) {slideIndex = 1}    
              if (n < 1) {slideIndex = slides.length}
              for (i = 0; i < slides.length; i++) {
                  slides[i].style.display = "none";  
              }
              for (i = 0; i < dots.length; i++) {
                  dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
            }
            </script>
            
            <?php
            print("<div class=\"productnaam\">" . $name . "</div>");
            if ($voorraad > 0) {
                print('<div class="productopvoorraad">Product is op voorraad</div>');
            } else {
                print('<div class="productnietvoorraad">Product is niet op voorraad</div>');
            }
            ?>
            <div class="formaantal">
                <form method="get" action=Winkelmandje.php>
                    <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" value=1 name="aantal">
                    <input class="toevoegenbutton" type="submit" name="submit" value="Toevoegen aan Winkelmandje">
                </form>
            </div>
            <?php print("<br><br><a href=\"leveranciers.php\" class=\"productleverancier\">Leverancier: " . $leverancier) . "</a>"; 

            print("<div class=\"productprijs\">€" . $prijs) . "</div><br><br><br>";
        }
        $_SESSION["naam"] = $naam;
        if (isset($_SESSION["winkelwagen"])) {
            $winkelwagen = $_SESSION["winkelwagen"];
        }
        if (empty($winkelwagen)) {
            $winkelwagen = array();
        }
        $_SESSION["winkelwagen"] = $winkelwagen;
        $_SESSION["prijs"] = $prijs;
        $_SESSION["voorraad"] = $voorraad;
        $_SESSION["itemID"] = $itemID;
        $pdo = NULL;
        ?>
        <?php
        print(footer());
        ?>
    </body>
</html>