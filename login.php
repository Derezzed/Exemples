<?php
# Syst�me de connexion comment�
# Author = Derezzed for Keillin
# Extrait de Sayms - CMS mis en vente
# Copyright 2012-2013 : Derezzed


		if (isset($_POST['logon'])) { // Si le formulaire de connexion est envoy� via le bouton, alors...
			
			$compte = htmlspecialchars(mysql_escape_string($_POST['login'])); // la variable $compte = ce que l'utilisateur � entr� dans la form nom de compte
			$password = htmlspecialchars(mysql_escape_string($_POST['passlog'])); // la variable $password = ce que l'utilisateur � entr� dans la form mot de passe
			# Tu remarqueras peut-�tre l'utilisation de : htmlspecialchars(mysql_escape_string($Variable)), qui permet de s�curiser les entr�es d�finies par le membre
			# Ca emp�che d'avoir des failles XSS plut�t g�nante. (je crois que c'est des XSS, je suis pas s�r...)

			$requete = mysql_query("SELECT * FROM accounts WHERE account = '".$compte."'"); // On s�lectionne dans la table accounts la colonne account, o� celle-ci = $compte (nom de compte entr� dans la form)
			$donnees = mysql_fetch_array($requete); // Ca, c'est pour r�cup�rer les donn�es
			if ($password == $donnees['pass']){ // Si $password = Mot de passe de la ligne du nom de compte entr�, alors...
				$_SESSION['login'] = $donnees['account']; // La variable $_SESSION['login'] est �gales au donn�es de la colonne 'account'
				$_SESSION['pseudo'] = $donnees['pseudo']; // La variable $_SESSION['pseudo'] est �gales au donn�es de la colonne 'pseudo'
				$_SESSION['level'] = $donnees['level']; // La variable $_SESSION['level'] est �gales au donn�es de la colonne 'level'
				$_SESSION['guid'] = $donnees['guid']; // La variable $_SESSION['guid'] est �gales au donn�es de la colonne 'guid'
				$_SESSION['points'] = $donnees['points']; // La variable $_SESSION['points'] est �gales au donn�es de la colonne 'points'
				header('Location: ?home'); // Ensuite, on redirige directement gr�ce au header location
			} else { // Sinon, si le mot de passe ne correspond pas, alors...
				
				echo '<center><div style="color: #991D1D; vborder: 1px dotted #991D1D; background: #DB5C5C;"> Mot de passe incorrect</div></center>'; // On �crit "Mot de passe incorrect".
			}
									} // Fin du code de connexion lorsque le formulaire est envoy�.
									
echo '<form method="post" action="">'; // On cr�� la form (= formulaire de connexion)
echo '<label>'; // On annonce un champs de texte � remplir
echo '<p>Nom de compte</p>'; // On �crit que l'on veut le nom de compte
echo '<input type="text" name="login" maxlength="10">'; // Form input pour le nom de compte
echo '</label>'; // On annonce que le champs � remplir s'arr�te ici
echo '<label>'; // Un deuxi�me champs...
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