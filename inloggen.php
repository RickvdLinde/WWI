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
    <body>
       <?php
       print(category());
       ?>
        <form method="POST" class="inloggen">
            <label for="user">Gebruikersnaam: </label><input type="text" id="user" name="user"><br>
            <label for="pass">Wachtwoord: </label><input type="password" id="pass" name="pass"><br>
            <input class="inloggenknop" type="submit" value="Inloggen">
        </form>
    </body>
</html>