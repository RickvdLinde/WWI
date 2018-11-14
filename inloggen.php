<?php
include("connect.php");
include("functions.php");

if (!empty($_POST['inloggenknop'])) {
     $usernameEmail=$_POST['user'];
     $password=$_POST['pass'];
     if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 ){
         $uid = userLogin($usernameEmail,$password);
         if($uid){
             header("Location: index.php"); 
} else {
    print("Verkeerd E-mailadres of wachtwoord.");
}
}
}
?>
*/
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

