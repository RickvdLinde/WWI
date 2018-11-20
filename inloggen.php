<?php
session_start();
include 'connect.php';
include 'functions.php';
$username = NULL;
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
        $_SESSION['logged_in'] = false;
        // Als inloggegevens overeenkomen met de inloggegevens in de database
        if ($passwordhash == $user['HashedPassword'] && $username == $user['LogonName']) {
            // Variabele session wordt aangemaakt en je wordt doorgestuurd naar de homepagina
            $_SESSION['user_id'] = $user['PersonID'];
            $_SESSION['logged_in'] = TRUE;
            header("location: index.php");
            exit;
        } else {
            // Bij eventuele andere errors
            print('Verkeerd E-mail of wachtwoord.');
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wide World Importers</title>
        <link rel="stylesheet" type="text/css" href="Mainstyle.css">
    </head>
    <body class="bodi">
        <?php
        print(category());
        if (!$_SESSION['logged_in']){ 
        print("<form method='POST' class='inloggen'>
            <label for='user'>E-mailadres: </label><input type='text' id='user' name='user'><br>
            <label for='pass'>Wachtwoord: </label><input type='password' id='pass' name='pass'><br>");
        }
            $usercheck = $_SESSION['logged_in'];
            if ($usercheck){
                print("U bent ingelogd");
                 print('<form action="inloggen.php">
            <input class="inloggenknop" type="submit" value="Uitloggen" name="Uitlogknop">
            </form>');
            } else {
                print('<input class="inloggenknop" type="submit" value="Inloggen" name="inloggenknop">');
            }
            if(isset($_GET["Uitlogknop"])){
                $_SESSION['logged_in'] = FALSE;
                header("Location: inloggen.php");
            }
            
            ?>
        </form>
    </body>
</html>

