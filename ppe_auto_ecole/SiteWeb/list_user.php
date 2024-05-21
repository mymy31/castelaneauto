<?php
try {
    $bd = new PDO("mysql:host=localhost;dbname=autoecole", "root", "");

    $request = $bd->prepare("SELECT * FROM Utilisateur");

    $request->execute();

    $users = $request->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>

    <thead>
        <tr>
            <th>Nom</th>
            <td>Prenom</td>
            <td>Adresse Mail</td>
            <td>Telephone Portable</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach( $users as $user ) : ?>
        <tr>
            <td><?= $user['Nom'] ?></td>
            <td><?= $user['Prenom'] ?></td>
            <td><?= $user['Email'] ?></td>
            <td><?= $user['Telephone'] ?></td>
            <td><a href="deleteuser.php?id=<?= $user['IdU'] ?>">Supprimer</a></td>
        </tr>
    <?php endforeach ; ?>
    </tbody>
    </table>
</body>
</html>