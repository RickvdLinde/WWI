<?php
session_start();
include 'functions.php';

// Databaseconnectie
$db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
$user = "root";
$pass = "";
$pdo = new PDO($db, $user, $pass);

//Als er geen errors zijn, blijven de errorvariabelen leeg
$wrongpass = ("");
$wrongemailformat = ("");
$emailexists = ("");
$passwordshort = ("");

// Gegevens registratieformulier
if (isset($_POST['registrerenknop'])) {
    $firstname = ucfirst(strtolower(filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING)));
    $lastname = ucfirst(strtolower(filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING)));
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $phonenumber = filter_input(INPUT_POST, "phonenumber", FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $confirmpassword = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_STRING);

    //Wachtwoord wordt gehashed zodat hij vergeleken kan worden met de wachtwoorden in de database.
    $hashedpassword = hash('sha256', $password);

    //$row wordt gemaakt om een het volgende PersonID te maken voor de eerstevolgende registratie.
    $row = $pdo->prepare("SELECT max(PersonID) FROM people");
    
    //Checked of er al iemand is met het emailadres dat is ingevuld.
    $user_check = $pdo->prepare("SELECT * FROM people WHERE EmailAddress = '$email'");
    $result = $user_check->fetch(PDO::FETCH_ASSOC);
    $user_check->execute();
    $row->execute();

    //Loop om het eerstvolgende PersonID uit te rekenen.
    while ($row2 = $row->fetch()) {
        $oldmaxID = $row2["max(PersonID)"];
        $newID = $oldmaxID + 1;
    }
    //Statement voor het toevoegen van de nieuwe geregistreerde gebruiker.
    $stmt = $pdo->prepare("INSERT INTO people (PersonID, FullName, PreferredName, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES ($newID, '$firstname $lastname', '$firstname', '$email', '$hashedpassword', '$phonenumber', '$email')");

    //Als er nog niemand is geregistreerd op dat account en de 2 wachtwoorden zijn hetzelfde, statement wordt uitgevoerd en je wordt ingelogd.
    if ($user_check->rowCount() == 0 && $password == $confirmpassword) {
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['LogonName'] = $email;
        header("location = index.php");
        $stmt->execute();
    } else {
        //Als het email format fout is, bijvoorbeeld geen @.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $wrongemailformat = ('<p class="errorsregistreren"><strong>Invalid email format.</strong></p>');
        } else {
            //Als het emailadres dat is ingevuld al in de database staat.
            if ($user_check->rowCount() > 0) {
                $emailexists = ('<p class="errorsregistreren"><strong>E-mailaddress already exists</strong></p>');
            }
        }
        //Als de 2 wachtwoorden niet gelijk zijn.
        if ($password != $confirmpassword) {
            $wrongpass = ('<p class="errorsregistreren"><strong>Passwords are not the same</strong></p>');
        }
        if (strlen($password) < 6) {
            //Als het wachtwoord korter dan 6 is.
            $passwordshort = ('<p class="errorsregistreren"><strong>Password is too short.</strong></p>');
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
        <link rel="icon" href="Images/archixl-logo.png">
    </head>
    <body>

        <?php
        print(category());
        //Als je niet bent ingelogd, print het formulier.
        if (!isset($_SESSION['logged_in'])) {
            print("<table class=\"registreren\"><form method='POST' class='inloggen'>
            <tr><td><label for='firstname'>First name: </label></td><td><input class=\"field\" type='text' id='firstname' name='firstname' maxlength='50' required></td></tr>
            <tr><td><label for='lastname'>Last name: </label></td><td><input class=\"field\" type='text' id='lastname' name='lastname' maxlength='50' required></td></tr>
            <tr><td><label for='email'>E-mailadress: </label></td><td><input class=\"field\" type='text' id='email' name='email' maxlength='50' required></td></tr>
            <tr><td><label for='phonenumber'>Phone number: </label></td><td><input class=\"field\" type='number' id='phonenumber' name='phonenumber' minlength='10' maxlength='14'></td></tr>
            <tr><td><label for='pass'>Password: </label></td><td><input class=\"field\" type='password' id='pass' name='password' maxlength='50' required></td></tr>
            <tr><td><label for='pass2'>Confirm password: </label></td><td><input class=\"field\" type='password' id='pass2' name='password2' maxlength='50' required></td></tr>
            <tr><td></td><td>Already have an account? Log in <a href=\"inloggen.php\">here</a></td></tr>
            <tr><td></td><td><input class=\"knopregister\" type=\"submit\" value=\"Register\" name=\"registrerenknop\"></td></tr>
            <tr><td></td><td>$wrongemailformat$emailexists$wrongpass$passwordshort</tr></td></table>");
        }
        ?>
    </form>
</body>
</html>

