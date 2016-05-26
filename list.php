<?php 

	require 'inc/db.php';

	//Nombre d'étudiants par page

	if(!empty($_GET['ses_id'])){

		$sesId = intval($_GET['ses_id']);

		$nbPerPage = 4;
		$currentOff = 0;

/*      Methode pour afficher via le offset dans la barre d url
		if(isset($_GET['offset'])){
		//equivaut à array_key_exists('offset', $_GET);

			$currentOff = intval($_GET['offset']);
		}
*/

		$currentPage = 1;

		if (array_key_exists('page', $_GET)) { // équivaut à isset($_GET['page'])

			$currentPage = intval($_GET['page']);
			$currentOff = ($currentPage-1) * $nbPerPage;
		}

		$sql = '
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
					ses_id = :sesId
				LIMIT
					:offset,:nbPerPage
				'
		;

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindValue(':sesId',$sesId, PDO::PARAM_INT);

		$pdoStatement->bindValue(':nbPerPage',$nbPerPage, PDO::PARAM_INT);

		//$pdoStatement->bindValue(':offset', $currentOff, PDO::PARAM_INT);
		$pdoStatement->bindValue(':offset', $currentOff, PDO::PARAM_INT);

		if($pdoStatement->execute() === false){

			print_r($pdo->errorInfo());
		}

		else if ($pdoStatement->rowCount() > 0){

			$etudiantListe = $pdoStatement->fetchAll();
		}
	}

	require 'inc/header.php';
	require 'inc/menu.php'; 
	require 'inc/list_view.php';
	require 'inc/footer.php'; 

 ?>