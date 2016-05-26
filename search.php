<?php 
	
	require 'inc/db.php';

	//Mettre ici le code pour la recherche
	$etudiantListe = array(); //variable a remplir

	if(!empty($_GET['search'])){

		$usrVal = $_GET['search'];

		$sql = 
			'
				SELECT
				  stu_id,
				  stu_name,
				  stu_firstname,
				  stu_email,
				  cou_name,
				  cit_name,
				  mar_name,
				  stu_birthdate AS birthdate
				FROM
				  	student
				LEFT OUTER JOIN
				 	 country ON country.cou_id = student.cou_id
				LEFT OUTER JOIN
				  	city ON city.cit_id = student.cit_id
				LEFT OUTER JOIN
				  	marital_status ON marital_status.mar_id = student.mar_id
				WHERE
			  		stu_name LIKE :toto
			  		OR stu_firstname LIKE :toto
			  		OR stu_email LIKE :toto
			  		OR cou_name LIKE :toto
			  		OR cit_name LIKE :toto
			  		OR mar_name LIKE :toto
			  		OR stu_birthdate LIKE :toto
			'
		;

		$pdoStatement = $pdo->prepare($sql);
		
		$pdoStatement->bindValue(':toto', '%'.$usrVal.'%');

		if($pdoStatement->execute() === false){

			$pdoStatement->errorInfo();
		}

		else if ($pdoStatement->rowCount() > 0){

			$etudiantListe = $pdoStatement->fetchAll();
			$msgSearch = 'Votre recherche a donné les résultats suivants : ';
		}

	}

	require 'inc/header.php';
	require 'inc/menu.php';
	require 'inc/list_view.php';
	require 'inc/footer.php';

 ?>
