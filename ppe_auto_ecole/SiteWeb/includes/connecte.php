				<div id="mon_compte">
					<form method="post" action="includes/sessiondestroy.php">
						<table border="0" id="connexion">
							<tr>
								<td align="middle">
									<label>tu n'es pas </label>
								</td>
								<td align="middle">
									<label><?php echo $_SESSION['prenom'] ?> ?</label><br/> 
								</td>
								<td rowspan="2">
									<input type="submit" value="Deconnexion" class="btn"/>
								</td>
							</tr>
							
						</table>
					</form>
				</div>