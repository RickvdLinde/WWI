<?php
include 'functions.php';
// Databaseconnectie
$db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
$user = "root";
$pass = "";
$pdo = new PDO($db, $user, $pass);

// Gegevens registratieformulier
if (isset($_POST['registrerenknop'])){
$firstname = ucfirst(filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING));
$lastname = ucfirst(filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING));
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
$phonenumber = filter_input(INPUT_POST, "phonenumber", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$confirmpassword = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_STRING);
  
$hashedpassword = hash('sha256', $password);

// SQL query voor het registreren
$stmt = $pdo->prepare("INSERT INTO people (FullName, PreferredName, LogonName, HashedPassword, PhoneNumber, EmailAdress)
        VALUES ('$firstname $lastname', '$firstname', $email', '$hashedpassword', '$phonenumber', '$email')");
$user_check = $pdo->prepare("SELECT * FROM people WHERE EmailAdress = '$email' AND HashedPassword = '$hashedpassword'");
$stmt->execute();
$result = $user_check->fetch(PDO::FETCH_ASSOC);
$user_check->execute();
 if ($user_check->rowCount() > 0) {
            $_SESSION['user_id'] = $user['PersonID'];
            $_SESSION['logged_in'] = TRUE;
            header("location = index.php");
 }
 if ($password != $confirmpassword){
     print("Passwords are not the same");
 }
 if (strlen($password) < 3) {
     print('Password is too short.');
        }
 if (strlen($confirmpassword) < 3) {
     print('Confirm password is too short.');
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

        if (!isset($_SESSION['logged_in'])) {
            print("<table class=\"registreren\"><form method='POST' class='inloggen'>
            <tr><td><label for='firstname'>First name: </label></td><td><input type='text' id='firstname' name='firstname' required></td></tr>
            <tr><td><label for='lastname'>Last name: </label></td><td><input type='text' id='lastname' name='lastname' required></td></tr>
            <tr><td><label for='email'>E-mailadress: </label></td><td><input type='text' id='email' name='email' required></td></tr>
            <tr><td><label for='phonenumber'>Phone number: </label></td><td><input type='text' id='phonenumber' name='phonenumber'></td></tr>
            <tr><td><label for='pass'>Password: </label></td><td><input type='password' id='pass' name='password' required></td></tr>
            <tr><td><label for='pass2'>Confirm password: </label></td><td><input type='password' id='pass2' name='password2' required></td></tr>
            <tr><td></td><td>Already have an account? Log in <a href=\"inloggen.php\">here</a></td></tr>
            <tr><td></td><td><input class=\"knopregister\" type=\"submit\" value=\"Registreren\" name=\"registrerenknop\"></td></tr></table>");
        }
        ?>
    </form>
</body>
</html>

