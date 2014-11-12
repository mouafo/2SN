<?php

	/*
	**  Ce wiki concerne le projet 2sn de la 17eme promotion de mars a ETNA
	** Il sera un guide qui nous aidera a coordoner nos actions et nos developeement
	** Ceci en definissant la norme de developpement a avoir
	*/

		Norme de la base de donnees
		Pour la conception de la base de donnees, les nom defini dans le MCD devrons etre respecter.
		  neanmoins, pour la base de donnees, elle sera nomme de la facon suivante :
		  -   bd_2sn : en general, tous nom concernant la base de donnees sera de la forme bd_[nom du projet].

		  Norme des tables (entity ous symphony)
		  En ce qui concerne les entites, comme nous l''avons dit plus haut, devra etre nommes de la meme facon
		  Que dans le modele MCD. Ceci etant, pour les differencier des autres variables, devrons avoir la forme
		  suivante :
		  -    Nom1_Nom2_* : Pour les entites composer de plusieurs mots, ils devrons etre separer par des "_".
		  de plus tout nom d''entites devra debutes par la majuscule suivi par des minuscule puis, aprs des "_"
		  par la majuscule. Il est a note que les entites ne pourrons que debuter par des caracteres alphabetique.
		  de plus, Tout autre variable declarer de devrons en aucun cas debuter par des majuscules. ce privilere 
		  est reserver aux entites.
		  
		  Les elements de la base de donnees (et object) sont de cette forme :
		  
		  Nom des classes :
		  
		  - Album : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ name (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Avis : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ favorable (boolean)
		  		+ unfavorable (boolean)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Complains : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ message (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Groups : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ name (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Group_Member : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Lessons : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ title (string)
		  		+ subject (string)
		  		+ file (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Lesson_Comment : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ subject (string)
		  	/*	+ create_date (datetime)
		  		+ edit_date (datetime) */ // les deux dernier attribut ne sont pas encore mis et serons ajouter sous peut
		  - Message : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ subject (string)
		  		+ sender (string)
		  		+ receiver (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Multimedia : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ name (string)
		  		+ ext (string)
		  		+ path (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Multimedia_Comment : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ comment (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Partner : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  	/*	+ create_date (datetime)
		  		+ edit_date (datetime) */ // les deux dernier attribut ne sont pas encore mis et serons ajouter sous peut
		  - Post : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ subject (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - Post_Solution : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ subject (string)
		  		+ file (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  - User : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ email (string)
		  		+ password (string)
		  		+ name (string)
		  		+ surname (string)
		  		+ state (int)
		  		+ born_date (datetime)
		  		+ job (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  		+ last_login_date (datetime)
		  - User_has_Avis : Avec comme attribut (sera mis a jour avec le temps mais la nomenclature de base reste inchanger)
		  		+ id (int)
		  		+ title (string)
		  		+ comment (string)
		  		+ create_date (datetime)
		  		+ edit_date (datetime)
		  	
Dans le fichier 	app/config/parameters.yml  il ya toutes la configuration pour le mapping avec MySQL
appercu de la config fonctionnel du projet
	parameters: { 
		database_driver: pdo_mysql, 
		database_host: 127.0.0.1, 
		database_port: 8889, 
		database_name: bd_2sn, 
		database_user: root, 
		database_password: root, 
		etc...
	}
		  		
----------------------========== End Model =============------------------------
?>
