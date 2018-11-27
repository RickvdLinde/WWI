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
            print("<form method='POST' class='inloggen'>
            <label for='firstname'>First name: </label><input type='text' id='firstname' name='firstname' required><br>
            <label for='lastname'>Last name: </label><input type='text' id='lastname' name='lastname' required><br>
            <label for='email'>E-mailadress: </label><input type='text' id='email' name='email' required><br>
            <label for='phonenumber'>Phone number: </label><input type='text' id='phonenumber' name='phonenumber'><br>
            <label for='pass'>Wachtwoord: </label><input type='password' id='pass' name='password' required><br>
            <label for='pass2'>Wachtwoord bevestigen: </label><input type='password' id='pass2' name='password2' required><br>
            Already have an account? Log in <a href=\"inloggen.php\">here</a>");
        }
       
        print('<input class="inloggenknop" type="submit" value="Registreren" name="registrerenknop">');

        ?>
    </form>
</body>
</html>

