<?php
session_start();

include "functions.php"
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
        <?php
        print(category());

$naam = $_GET["product"];

$Hasquotations = strpos($naam, '" ');
                $naam = preg_replace('/_/',' ', $naam);
            if ($Hasquotations) {
            $newnaam = strstr($naam, '" ');
                            $newnaam = preg_replace('/"/', ' ', $newnaam);
} else {
                $newnaam = $naam;
            }

            $itemresults = array();
            $keyres = 0;
            $itemresultsCat = array();
            $keyresCat = 0;
            $priceresults = array();
            $keyresprice = 0;
            $Stockresults = array();
            $keyresStock = 0;
            $Suplierresults = array();
            $keyresSupplier = 0;

        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);      

        

        $stmt = $pdo->prepare("SELECT s.StockItemID, StockItemName, RecommendedRetailPrice, QuantityOnHand, MarketingComments, SupplierName FROM stockitems s JOIN stockitemholdings h ON s.StockItemID = h.StockItemID JOIN suppliers l
        ON s.SupplierID = l.SupplierID WHERE StockItemName LIKE ? ");

        $stmt->execute(array("%$newnaam%"));


        while ($row = $stmt->fetch()) {
            
            $itemID = $row["StockItemID"];
            $name = $row["StockItemName"];
            $prijs = $row["RecommendedRetailPrice"];
            $voorraad = $row["QuantityOnHand"];
            $comment = $row["MarketingComments"];
            $leverancier = $row["SupplierName"];


            $itemresults[$keyres] = $name;
$keyres++;
            $itemresultsCat[$keyresCat] = $naam;
$keyresCat++;
            $priceresults[$keyresprice] = $prijs;
$keyresprice++;
            $Stockresults[$keyresStock] = $voorraad;
$keyresStock++;
            $Suplierresults[$keyresSupplier] = $leverancier;
$keyresSupplier++;

}
        //als er een keuze is gemaakt uit de dropdownlist is deze if true, hij laadt het product zien met de value van de dropdownlist
if(isset($_POST['small'])) {
$dropdowncount = $_POST["small"];

            ?>
          <div class="productgegevens">
                <div class="image-placeholder">

                </div>
                <div class="gegevenszonderafbeeling">
                    <?php
                    print("<div class=\"productnaam\">" . $itemresults[$dropdowncount] . "</div>");
                    print("<div class=\"productprijs\">€" . number_format($priceresults[$dropdowncount], 2, ",", ".")) . "</div><br><br><br>";
                                if ($voorraad > 0) {
                print('<div class="productopvoorraad">Product is available</div>');
            } else {
                print('<div class="productnietvoorraad">Product is not available</div>');
            }
                    ?>
                    <div class="formaantal">
                        <form method="get" action=Winkelmandje.php>
                            <label for="aantal">Aantal Producten: </label><input type="number" id="aantal" name="aantal" value="1">
                            <input class="toevoegenbutton" type="submit" name="submit" value="Add to Cart">
                        </form>
                    </div>
                    <?php print("<br><br><a href=\"leveranciers.php\" class=\"productleverancier\">Suppliers: " . $Suplierresults[$dropdowncount]) . "</a>";
                    ?>
                </div>
            </div>   
<?php
} 

// om tot een dropdownlist te komen, moet er bepaald worden wat het verschil is tussen de categorienaam en de volledige naam. Dit gebeurt in de volgende code.         
$arraynumitemres = array();
            $keyresnum = 0;
$arraynumitemresCat = array();
            $keyresnumCat = 0;
            //bepalen lengte itemnamen
        foreach ($itemresults as $itemres) {
            $arraynumitemres[$keyresnum] = strlen($itemres);
            $keyresnum++;
        }
        //bepalen lengte itemcategorienamen
        foreach ($itemresultsCat as $itemrescat) {
            $arraynumitemresCat[$keyresnumCat] = strlen($itemrescat);
            $keyresnumCat++;
        }

// bepalen verschil tussen de lengte van de categorieen en de namen om het verschil te zien te krijgen in cijfers.
                $arraynumitemresdiff = array();
            $keyresnumdiff = 0;
                foreach ($arraynumitemres as $keyresnumdiff => $ANIR) {
                    $arraynumitemresdiff[$keyresnumdiff] = $ANIR - $arraynumitemresCat[$keyresnumdiff];
                    $keyresnumdiff++;
                }
                //het verschil in een array te zien krijgen omgezet van cijfers naar letters.
                $arraydropdowns = array();
            $keydropdowns = 0;  
            foreach ($itemresults as $dropres) {
    $arraydropdowns[$keydropdowns] =  substr($dropres, $arraynumitemresCat[$keydropdowns], $arraynumitemresdiff[$keydropdowns]);
    $keydropdowns++;
}
$keysizeANDcolor = 0;

                if(array_key_exists(1, $arraydropdowns)){

 //de dropdownlist       
print('<div class="drop"> <form id="s" method="post">');
                print("<select name='small'>");
                                if(!isset($_POST['small'])) {
                foreach ($arraydropdowns as $ADDown) {
                    print("<option value=" . $keysizeANDcolor . " selected>" .  trim($ADDown, " - ") . "</option>");
                    $keysizeANDcolor++;
                }}
                                if(isset($_POST['small'])) {
                                                    foreach ($arraydropdowns as $ADDown) {
                                                        if($keysizeANDcolor != $dropdowncount){
                                                        print("<option value=" . $keysizeANDcolor . " selected>" .  trim($ADDown, " - ") . "</option>");}
                    $keysizeANDcolor++;
                                                    }
                print("<option value=" . $dropdowncount . " selected>" .  trim($arraydropdowns[$dropdowncount], " - ") . "</option>");}
                print("</select>");
                print('<input type="submit" name="Submit" value="Confirm">');
                print("</form>");
                } print("</div>");


                $setkey = 0;
                    if(!isset($_POST['small'])) {
                        $setkey = count($arraydropdowns) -1;                                            
         
  ?> 
            <div class="productgegevens">
                <div class="image-placeholder">

                </div>
                <div class="gegevenszonderafbeeling">
                    <?php
                    print("<div class=\"productnaam\">" . $itemresults[$setkey] . "</div>");
                                print("<div class=\"productprijs\">€" . number_format($priceresults[$setkey], 2, ",", ".")) . "</div><br><br><br>";
                    //print("<div class=\"productvoorraad\">Producten op voorraad: " . $Stockresults[0] . "<br><br>");
                                if ($voorraad > 0) {
                print('<div class="productopvoorraad">Product is available</div>');
            } else {
                print('<div class="productnietvoorraad">Product is not available</div>');
            }
                    ?>
                    <div class="formaantal">

                        <form method="get" action="winkelmandje.php">
                            <label for="aantal">Number of products: </label><input type="number" id="aantal" name="aantal" value="1">
                            <input class="toevoegenbutton" type="submit" name="submit" value="Add to Cart">

                        </form>
                    </div>
                    <?php print("<br><br><a href=\"leveranciers.php\" class=\"productleverancier\">Supplier: " . $Suplierresults[$setkey]) . "</a>";
                    }?>
                </div>
            </div>

        <!--De slider met de images-->
        <div class="slider">
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


        if (isset($_SESSION["winkelwagen"])) {
            $winkelwagen = $_SESSION["winkelwagen"];
        }
        if (empty($winkelwagen)) {
            $winkelwagen = array();
                    }
                    if(isset($_POST['small'])) {
        $_SESSION["winkelwagen"] = $winkelwagen;
                $_SESSION["naam"] = $itemresults[$dropdowncount];
        $_SESSION["prijs"] = $priceresults[$dropdowncount];
        $_SESSION["voorraad"] = $Stockresults[$dropdowncount];
        $_SESSION["itemID"] = $itemID;
                    } else {
                                $_SESSION["winkelwagen"] = $winkelwagen;
                                        $_SESSION["naam"] = $itemresults[$setkey];
        $_SESSION["prijs"] = $priceresults[$setkey];
        $_SESSION["voorraad"] = $Stockresults[$setkey];
        $_SESSION["itemID"] = $itemID;
                    }
        $pdo = NULL;
        ?>
        
    </body>
</html>