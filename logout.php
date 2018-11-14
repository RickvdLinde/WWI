<?php
include('connect.php');
$session_PersonID='';
$_SESSION['PersonID']=''; 
if(empty($session_PersonID) && empty($_SESSION['PersonID'])) {
header("Location: $url");
}
?>


