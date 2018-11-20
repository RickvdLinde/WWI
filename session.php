<?php
include 'connect.php';
session_start();
$usercheck = $_SESSION['logged_in'];
if (isset($usercheck)):?>
    <a href="loguit.php">Uitloggen</a>
<?php else: ?>
    <a href="inloggen.php">Inloggen</a>
<?php endif; ?>




