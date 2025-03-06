<?php
session_start();

if(isset($_SESSION['loggato'])){
    header("location: ../area_personale/area_personale.php");
    exit();
}

$_SESSION['loggato'] = true;
$_SESSION['username'] = 'ospite';
header("location: ../area_personale/area_personale.php");
exit();
?>