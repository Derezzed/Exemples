<?php
# Système de connexion commenté
# Author = Derezzed for Keillin
# Extrait de Sayms - CMS mis en vente
# Copyright 2012-2013 : Derezzed


		if (isset($_POST['logon'])) { // Si le formulaire de connexion est envoyé via le bouton, alors...
			
			$compte = htmlspecialchars(mysql_escape_string($_POST['login'])); // la variable $compte = ce que l'utilisateur à entré dans la form nom de compte
			$password = htmlspecialchars(mysql_escape_string($_POST['passlog'])); // la variable $password = ce que l'utilisateur à entré dans la form mot de passe
			# Tu remarqueras peut-être l'utilisation de : htmlspecialchars(mysql_escape_string($Variable)), qui permet de sécuriser les entrées définies par le membre
			# Ca empêche d'avoir des failles XSS plutôt génante. (je crois que c'est des XSS, je suis pas sûr...)

			$requete = mysql_query("SELECT * FROM accounts WHERE account = '".$compte."'"); // On sélectionne dans la table accounts la colonne account, où celle-ci = $compte (nom de compte entré dans la form)
			$donnees = mysql_fetch_array($requete); // Ca, c'est pour récupérer les données
			if ($password == $donnees['pass']){ // Si $password = Mot de passe de la ligne du nom de compte entré, alors...
				$_SESSION['login'] = $donnees['account']; // La variable $_SESSION['login'] est égales au données de la colonne 'account'
				$_SESSION['pseudo'] = $donnees['pseudo']; // La variable $_SESSION['pseudo'] est égales au données de la colonne 'pseudo'
				$_SESSION['level'] = $donnees['level']; // La variable $_SESSION['level'] est égales au données de la colonne 'level'
				$_SESSION['guid'] = $donnees['guid']; // La variable $_SESSION['guid'] est égales au données de la colonne 'guid'
				$_SESSION['points'] = $donnees['points']; // La variable $_SESSION['points'] est égales au données de la colonne 'points'
				header('Location: ?home'); // Ensuite, on redirige directement grâce au header location
			} else { // Sinon, si le mot de passe ne correspond pas, alors...
				
				echo '<center><div style="color: #991D1D; vborder: 1px dotted #991D1D; background: #DB5C5C;"> Mot de passe incorrect</div></center>'; // On écrit "Mot de passe incorrect".
			}
									} // Fin du code de connexion lorsque le formulaire est envoyé.
									
echo '<form method="post" action="">'; // On créé la form (= formulaire de connexion)
echo '<label>'; // On annonce un champs de texte à remplir
echo '<p>Nom de compte</p>'; // On écrit que l'on veut le nom de compte
echo '<input type="text" name="login" maxlength="10">'; // Form input pour le nom de compte
echo '</label>'; // On annonce que le champs à remplir s'arrête ici
echo '<label>'; // Un deuxième champs...
echo '<p>Mot de passe</p>'; // idem qu'au dessus hein
echo '<input type="password" name="passlog" maxlength="10">'; // Form input pour le mot de passe
echo '</label>'; // Fermeture du champs
echo '<div style="height:10px"></div>'; // Pour le design
echo '<center><input type="submit" name="logon" value="Connexion"></center>'; // Form boutton pour envoyer le formulaire une fois remplis
echo '</form>'; // Fermeture de la form
echo '<ul id="login_form_links">'; // Design
echo '<li><a href="?register">Pas encore inscrit ?</a></li>'; // Link pour s'enregistrer
echo '</ul>'; // Design
?>