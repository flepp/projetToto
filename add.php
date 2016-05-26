<?php 

	require 'inc/db.php';

	$etudiantListe = array();

	$citiesList = array(
		6 => 'Arlon',
		1 => 'Luxembourg',
		4 => 'Verdun',
		2 => 'Longwy',
		10 => 'Rodange',
		7 => 'Pissange',
		12 => 'Pétange'
	);

	$countriesList = array(
		1 => 'France',
		2 => 'Luxembourg',
		3 => 'Belgique',
		4 => 'Chine',
		12=>'Allemagne'
	);

	$maritalStatusList = array(
		1 => 'Célibataire',
		2 => 'Marié(e)',
		3 => 'Divorcé(e)',
		4 => 'Veuf/veuve'
	);

	$sessionList = array(
		1 => 'Session 1',
		2 => 'Session 2',
		3 => 'Session 3'
		
	);

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
		'
	;

	$pdoStatement = $pdo->query($sql);

	$errorList=array();

	if(!empty($_POST)){

		// Je récupère tous les champs du formulaires
		// si isset($_POST['studentName']) == true alors récupère la valeur de $_POST['studentName'], sinon, la valeur ''
		print_r($_POST);
		$nom = isset($_POST['studentName']) ? $_POST['studentName'] : '';

		/* equivaut a if(isset($_POST['studentName'])){
		
			$name = $_POST['studentName'];
		}
		else{
		
			$name = '';
		}
		*/

		$prenom = isset($_POST['studentFirstname']) ? $_POST['studentFirstname'] : '';
		$mail = isset($_POST['studentEmail']) ? $_POST['studentEmail'] : '';
		$naissance = isset($_POST['studentBirhtdate']) ? $_POST['studentBirhtdate'] : '';
		$ville = isset($_POST['cit_id']) ? $_POST['cit_id'] : 0;
		//valeur du champ select correspondra aux valeurs de cit_id dans la BDD
		$countryID = isset($_POST['cou_id']) ? intval($_POST['cou_id']) : 0;
		$maritalID = isset($_POST['mar_id']) ? intval($_POST['mar_id']) : 0;
		$sesID = isset($_POST['ses_id']) ? intval($_POST['ses_id']) : 0;

		if (empty($nom)) {
			$errorList[] = 'Le nom est vide';
		}
		if (empty($prenom)) {
			$errorList[] = 'Le prénom est vide';
		}
		if (empty($mail)) {
			$errorList[] = 'L\'email est vide';
		}
		else if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
			$errorList[] = 'L\'email est incorrect';
		}
		if (empty($naissance)) {
			$errorList[] = 'La date de naissance est vide';
		}
		if (empty($ville)) {
			$errorList[] = 'La ville est manquante';
		}
		if (empty($countryID)) {
			$errorList[] = 'La nationalité est manquante';
		}

		if (empty($maritalID)) {
			$errorList[] = 'Le statut est manquant';
		}

		if (empty($errorList)) {
				

			$sqlIns =

				'
				INSERT INTO

						student
					(	
						stu_name,
						stu_firstname,
						stu_email,
						stu_birthdate,
						cit_id,
						cou_id,
						mar_id,
						ses_id

					)
					VALUES
					(
						:name,
						:firstName,
						:mail,
						:birth,
						:city,
						:country,
						:status,
						:sesID
					)
				'

			;

			$pdoStatement = $pdo->prepare($sqlIns);
			$pdoStatement->bindValue(':name', $nom);
			$pdoStatement->bindValue(':firstName', $prenom);
			$pdoStatement->bindValue(':mail', $mail);
			$pdoStatement->bindValue(':birth', $naissance);
			$pdoStatement->bindValue(':city', $ville);
			$pdoStatement->bindValue(':country', $countryID);
			$pdoStatement->bindValue(':status', $maritalID);
			$pdoStatement->bindValue(':sesID', $maritalID);

			if($pdoStatement->execute() === false){

				print_r($pdo->errorInfo());
			}

			else if ($pdoStatement->rowCount() > 0){

				echo 'Etudiant ajouté à la base de données !';
	
			}
		}

		// Sinon, afficher le contenu du tableau $errorList dans view.php

	}

require 'inc/header.php';
require 'inc/menu.php'; 
require 'inc/add_view.php';
require 'inc/footer.php'; 
 ?>