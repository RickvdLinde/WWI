<?php
session_start();
require 'connect.php';
require 'functions.php';
if (isset($_POST['inloggenknop'])) {
    $username = !empty($_POST['user']) ? trim($_POST['user']) : null;
    $passwordAttempt = !empty($_POST['pass']) ? trim($_POST['pass']) : null;
    $passwordhash = hash('sha256', $passwordAttempt);
    $sql = "SELECT PersonID, LogonName, HashedPassword FROM people WHERE LogonName = :LogonName AND HashedPassword = :HashedPassword";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':LogonName', $username);
    $stmt->bindValue(':HashedPassword', $passwordhash);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        die('Incorrect username / password combination!');
    } else {
        $validPassword = password_verify($passwordhash, $user['HashedPassword']);
        if ($passwordhash == $user['HashedPassword']) {
            $_SESSION['user_id'] = $user['PersonID'];
            $_SESSION['logged_in'] = time();
            header("location: index.php");
            exit;
        } else {
            die('Incorrect username / password combination!');
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
?>
    <body>
       <?php
       print(category());
       ?>
        <form method="POST" class="inloggen">
            <label for="user">E-mailadres: </label><input type="text" id="user" name="user"><br>
            <label for="pass">Wachtwoord: </label><input type="password" id="pass" name="pass"><br>
            <input class="inloggenknop" type="submit" value="Inloggen" name="inloggenknop">
        </form>
    </body>
</html>

