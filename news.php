<?php
								########################
								# Page d'accueil DzCMS #
								# @Author = Derezzed   #
								########################
								
	# En guise de tutoriel semi-complet, je te file cette page commentée, lis la bien.
	# Elle devrait t'apprendre les bases du PHP, mais les echo des news ne sont pas sécurisés
	# En plus de ça, une petite recherche sur le net devrait bien t'aider.
	# Avec ce que t'apprendra ici et dans le fichier login, tu pourras presque créer un CMS
	
	
	# CONFIGURATION SQL
	$Hote = 'localhost'; // Adresse de la bdd
	$Port = '3306'; // Port de la bdd 
    $Bdd = 'ancestrag'; // Nom de la bdd
	$utilisateur = 'root'; // utilisateur de la bdd, par défault root
	$pass = ''; // Mot de passe la bdd
	$connexion = new PDO('mysql:host='.$Hote.';port='.$Port.';dbname='.$Bdd, $utilisateur, $pass); // Connexion PDO à la base de donnée
	# FIN DE LA CONFIGURATION SQL
	
	# DEBUT DE LA PAGE
	// Début du système de cache
	$cache = './cache/news.html';  // On définit le nom de fichier et le répertoire où doit être créé le fichier de cache
	$expire = time() -3600 ; // On définit la durée du fichier cache en seconde avant qu'il soit changé/renouvellé
 
		if(file_exists($cache) && filemtime($cache) > $expire) // On vérifie que le fichier cache existe, et qu'il n'a pas expiré
			{ // Si c'est le cas :
			
				readfile($cache); // On lit et on inclue le fichier cache news.html
				
			} // Fermeture du "Si c'est le cas"
			else // Sinon, si il n'existe pas, on le créé 
			{ // Ouverture de la condition CACHE_ADD
			
				ob_start(); // ouverture du tampon, pour imprimer le contenu de la page
	// Fin du système de cache (suite plus bas)
	
	// Début de la requête PHP
	$requête = $connexion->query('SELECT * FROM news ORDER BY id DESC LIMIT 0,5'); // On envois la requête à la connexion PDO, le "query" permet d'envoyer une requête à la BDD. 
																				   //Ici, on selectionne la table news, que l'on ordonne par "id" de façon décroissante, avec 5 news maximum
																				   
	while ($donnees = $requête->fetch()) // On effectue une boucle des données récupérées plus haut grâce à la requête nommée "$requête".
		{ // Ouverture de la boucle NEWS
?>
		<h2>
			<?php 
				echo $donnees['titre']; 
				// On affiche le titre de la news récupérée via la requête, et le "echo" permet de l'afficher directement
				// Ici, on voit "$donnees['titre'], ce qui veut dire qu'on demande à la variable $donnees, qui a récupéré les données la query SQL, d'afficher la donnée nommée "titre"
			?>
		</h2> 
				
		<p class="content">
			<?php
				echo $donnees['contenu']; 
				// De la même façon que la variable titre, la variable $donnees['contenu'] affiche les données contenues dans la colonne contenu de la table news
			?>
		</p>
					
		<p class="sign">Le 
		<?php 
			echo $donnees['date']; 
			// On demande d'afficher la date, de la même façon que les précédente
		?>
		</p>
<br />

<?php
		} // Fermeture de la boucle NEWS
			
	$requête->closeCursor(); // On ferme la connexion PDO, pour éviter les problèmes
	
	$page = ob_get_contents(); // On récupére le contenu du tampon ouvert plus haut
    ob_end_clean(); // On remet à zéro le tempon
        
    file_put_contents($cache, $page) ; // On insert les données récupérées du tampon, et on l'insert dans le fichier cache qui va être créé pour la même occasion
									   // Tu pourras le retrouver dans le dossier cache que tu devras créer, et le fichier s'appelleras news.html (comme déclaré un peu plus haut
									   // Tu pourras voir en l'ouvran qu'il contient toutes les données des news
	
    echo $page ; // Pour finir, on affiche la page cache qu'on vient de créer
	
		} // Fermeture de la condition CACHE_ADD
		
	# FIN DE LA PAGE
	# Tout à été expliqué pour que ce soit compréhensible facilement
	# Bonne chance pour comprendre, j'ai tout indenté pour la même occasion
	
	# @Author = Derezzed
?>
