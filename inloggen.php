<?php
session_start();
include("connect.php");
include("functions.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       $username = !empty($_POST['user']) ? trim($_POST['user']) : null;
       $passwordAttempt = !empty($_POST['pass']) ? trim($_POST['pass']) : null;
       $hashed_password = hash('sha256', $_POST['pass']);
            
       $sql = "SELECT PersonID, LogOnName, HashedPassword FROM people WHERE IsPermittedToLogon = 1 AND LogOnName = :LogonOnName";
       $stmt = $pdo->prepare($sql);
       $stmt->bindValue(':LogOnName', $username);
       $stmt->execute();
       
       $user = $stmt->fetch(PDO::FETCH_ASSOC);
       
       if ($user === false){
           print("Verkeerd E-mailadres of wachtwoord.");
       } else{
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        if($validPassword){
            
            $_SESSION['user_id'] = $user['PersonID'];
            $_SESSION['logged_in'] = time();

            header('Location: index.php');
            exit;
            
        } else{
            die('Verkeerd E-mailadres of wachtwoord.');
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
        <form method="POST" class="inloggen">
            <label for="user">E-mailadres: </label><input type="text" id="user" name="user"><br>
            <label for="pass">Wachtwoord: </label><input type="password" id="pass" name="pass"><br>
            <input class="inloggenknop" type="submit" value="Inloggen" name="inloggenknop">
        </form>
    </body>
</html>

