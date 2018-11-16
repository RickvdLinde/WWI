<?php
include 'connect.php';
session(start);
$usercheck = $_SESSION['user_id'];
if (isset($usercheck)):?>
    <a href="loguit.php">Uitloggen</a>
<?php else: ?>
    <a href="inloggen.php">Inloggen</a>
<?php endif; ?>




