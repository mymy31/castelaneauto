<?php 
session_start();

try
{
	$bdd=new PDO('mysql:host=localhost;dbname=autoecole', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}


$login = (stripslashes($_POST['login']));
$mdp = (stripslashes($_POST['password']));
$login = (htmlspecialchars($login));
$mdp = (htmlspecialchars($mdp));
/*pregmatch ne fonctionne pas, à demander.. Peut etre normal vu qu'il y a un stripslashes et un htmlspecialchars
if (preg_match("#^[a-zA-Z]+$#",  "$login") OR preg_match("#^[a-zA-Z]+$#",  "$mdp"))
{ */
	$sql = $bdd->prepare('SELECT Moniteur.IdM, PrenomM FROM moniteur INNER JOIN identifiants ON moniteur.IdM=identifiants.IdM AND Login = ? AND MdP = ?');
	$sql->execute(array($login, $mdp));
	$count = $bdd->prepare('SELECT COUNT(Moniteur.IdM) as nbidm FROM moniteur INNER JOIN identifiants ON moniteur.IdM=identifiants.IdM AND Login = ? AND MdP = ?');
	$count->execute(array($login, $mdp));

	while ($donnees = $count->fetch())
	{
		if ($donnees['nbidm'] > 0)
		{
			$_SESSION['nbrate']=0;
			while ($donnees = $sql->fetch())
			{
				if ($donnees['IdM'] > 0)
				{
					$_SESSION['IDM'] = $donnees['IdM'];
					$_SESSION['prenom'] = $donnees['PrenomM'];
					unset($_SESSION['failLogin']);
					$_SESSION['nbrate']=0;
				}
				else 
				{
					unset($_SESSION['IDM']);
					unset($_SESSION['prenom']);
					$_SESSION['failLogin'] = $login;
					$_SESSION['nbrate']=$_SESSION['nbrate']+1;
				}
			}
		}
		else 
		{
			$_SESSION['nbrate']=$_SESSION['nbrate']+1;
			$_SESSION['failLogin'] = $login;
		}
	}	

	
/*}
else 
{
	$_SESSION['Loginfail'] = 'Caracteres et chiffres interdits';
}*/
	
	
	

header('Location: accueil.php');
?>