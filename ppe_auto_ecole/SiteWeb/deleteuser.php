<?php
try {
    $bd = new PDO("mysql:host=localhost;dbname=autoecole", "root", "");

    $request = $bd->prepare("DELETE FROM Utilisateur WHERE IdU = ?");

    $request->execute(array($_GET['id']));


    header("Location: list_user.php");
    
} catch (PDOException $e) {
    echo $e->getMessage();
}