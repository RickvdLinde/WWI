<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
  $AGs = filter_input(INPUT_GET,
    "product", FILTER_SANITIZE_STRING);
  print($AGs); //we kennen hem weer!! 
?>

    </body>
</html>
