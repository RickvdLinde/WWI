<?php
session_start();
include 'functions.php';
// Databaseconnectie
$db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
// Als inlogknop is ingedrukt
if (isset($_POST['inloggenknop'])) {
    // Haal E-mailadres en wachtwoord uit de textvelden
    $username = !empty($_POST['user']) ? trim($_POST['user']) : null;
    $passwordAttempt = !empty($_POST['pass']) ? trim($_POST['pass']) : null;
    
    // Wachtwoord wordt gehashed
    $passwordhash = hash('sha256', $passwordAttempt);
    
    // Inloggegevens uit database
    $sql = "SELECT PersonID, LogonName, HashedPassword FROM people WHERE LogonName = :LogonName AND HashedPassword = :HashedPassword";
    $stmt = $pdo->prepare($sql);
    
    // De inloggegevens worden gebind met de inloggegevens uit de database
    $stmt->bindValue(':LogonName', $username);
    $stmt->bindValue(':HashedPassword', $passwordhash);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Als de inloggegevens fout zijn
    if ($user === false) {
        print('Verkeerd E-mail of wachtwoord.');
    } else {
        // Als inloggegevens overeenkomen met de inloggegevens in de database
        if ($passwordhash == $user['HashedPassword'] && $username == $user['LogonName']) {
            // Variabele session wordt aangemaakt en je wordt doorgestuurd naar de homepagina
            $_SESSION['user_id'] = $user['PersonID'];
            $_SESSION['logged_in'] = TRUE;
        } else {
            // Bij eventuele andere errors
            print('Verkeerd E-mail of wachtwoord.');
        }
    }
}
$pdo = NULL;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
        <link rel="stylesheet" type="text/css" href="style2.css">
        <link rel="icon" href="Images/archixl-logo.png">
    </head>
    <body>
        <?php
        print(category());
        if (!isset($_SESSION['logged_in'])){ 
        print("<form method='POST' class='inloggen'>
            <label for='user'>E-mailadres: </label><input type='text' id='user' name='user' required><br>
            <label for='pass'>Wachtwoord: </label><input type='password' id='pass' name='pass' required><br>");
        }
            if (isset($_SESSION['logged_in'])){
                header("location:index.php");
            } else {
                print('<input class="inloggenknop" type="submit" value="Inloggen" name="inloggenknop">');
            }
            print(footer());
            ?>
        </form>
    </body>
</html>

