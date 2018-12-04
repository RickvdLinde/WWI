<?php
session_start();
include 'functions.php';
// Databaseconnectie
$db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    
    $false = "";
    
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
    if ($passwordhash == '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918' && $username == 'admin@wideworldimporters.com'){
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['logged_in_admin'] = TRUE;
    } else {
    if ($user === false || $beheerder === false) {
        $false = ('<p class="errorsinloggen"><strong>Wrong combination of E-mail and password</strong></p><br>');
    } else {
        // Als inloggegevens overeenkomen met de inloggegevens in de database
        if ($passwordhash == $user['HashedPassword'] && $username == $user['LogonName']) {
            // Variabele session wordt aangemaakt en je wordt doorgestuurd naar de homepagina
            $_SESSION['LogonName'] = $user['LogonName'];
            $_SESSION['logged_in'] = TRUE;
        } else {
            // Bij eventuele andere errors
            $false = ('<p class="errorsinloggen"><strong>Wrong combination of E-mail and password</strong></p><br>');
        }
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
            <label for='user'>E-mail: </label><input type='text' id='user' name='user' maxlength='50' required><br>
            <label for='pass'>Password: </label><input type='password' id='pass' name='pass' maxlength='50' required><br>$false");
        }
            if (isset($_SESSION['logged_in'])){
                header("location:index.php");
            } else {
                print('<input class="inloggenknop" type="submit" value="Sign In" name="inloggenknop"><br>');
                print('<a href="registreren.php" class="registreerknop">Register</button>');
            }
            if (isset($_SESSION['logged_in_admin'])){
                header("location:index.php");
            }
            ?>
        </form>
    </body>
</html>

