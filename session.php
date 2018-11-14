<?php
if(!empty($_SESSION['PersonID']))
{
$session_PersonID=$_SESSION['PersonID'];
include('functions.php');
$userLogin= new userLogin();
}
if(empty($session_uid))
{
header("Location: $url");
}
?>

