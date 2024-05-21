<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<html style="height:100%">


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>CastellaneAuto - Login</title>
	</head>	


	<form id="mon_compte" method="post" action="connexion_post.php">
		<div>
			<label for="login">Login :</label><br />
			<input type="login" name="login" id="login" value="<?php 
										if (isset($_SESSION['failLogin']))
										{
											echo $_SESSION['failLogin'];
										}
										else
										{
											echo 'Votre identifiant';
										}
										?>" onclick="this.value=''" <?php 
										if ((isset($_SESSION['failLogin'])))
										{ 
										?>
											style="border-color:red"<?php
										}
										else 
										{
											
										}
										?>/>
		</div>
		<div>
			<label for="pass">Mot de passe :</label><br />
			<input type="password" name="password" id="pass" onclick="this.value=''"/>
				<?php
						if (isset($_SESSION['failLogin']))
							{
								echo '<td align="middle" style="border-color:red">
											<label>Missed</label>
											</td>';
							}
				?>
		</div>
		
		<input type="submit" value=">" class="btn"/>
	</form>