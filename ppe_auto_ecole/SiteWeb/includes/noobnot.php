<?php

session_start();
$_SESSION['nbvisite']=$_SESSION['nbvisite']+1;
$_SESSION['nbrate']=0;

header('location: ../accueil.php');
?>