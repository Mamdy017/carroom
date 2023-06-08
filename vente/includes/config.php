<?php
	
	function pdo_connect_mysql(){
	    // Mettez à jour les détails ci-dessous avec les données de votre base de données MySQL.
	    $DATABASE_HOST = 'localhost';
	    $DATABASE_USER = 'root';
	    $DATABASE_PASS = '';
	    $DATABASE_NAME = 'cityrental';
	    try {
	 return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	    } catch (PDOException $exception) {
	   // S'il y a une erreur de connexion, arrêtez le script et affichez le message erreur.
	      exit('Echec de la connexion à la base de données !');
	    }
	}
	// Template de l'entete de notre page, vous pouvez le personnaliser.
	
	// Obtenez le nombre de produits dans le panier, il sera affiché dans l'en-tête.
	$vente_panier = isset($_SESSION['vente_panier'])? count($_SESSION['vente_panier']) : 0;
     
	
	// Template pied de page
