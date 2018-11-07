<?php
include "functions.php"
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
            <input class="inloggenknop" type="submit" value="Inloggen"><br>
            <input class="registrerenknop" type="submit" value="Registreren">
        </form>
    </body>
</html>