<?php

/*
On veut insérer la liste complète des étudiants de la session 2 dans la table student.
On dispose de certaines informations dans le tableau se trouvant dans students_session2.php.
Cependant, des étudiants sont déjà renseignés dans la table student. Il ne faut donc ajouter que les étudiants n'y figurant pas.
Pour savoir si un étudiant est déjà dans la table, on se basera sur le champ "email".
D'ailleurs, pour plus de sécurité, on va ajouter un attribut d'unicité sur ce champ, dans la table student.

Copiez ces 2 fichiers dans un répertoire batch de votre projet Toto, puis éditez ce fichier pour effectuer les insertions en DB.
*/

require 'inc/db.php';
require 'students_session2.php';

// A vous de jouer ^^

$allNoMail = '
			SELECT
				*
			FROM 
				student
			WHERE 
				stu_email = :email
		';

$pdoStatement = $pdo->prepare($allNoMail);

foreach ($studentsList as $key => $mail) {

	$pdoStatement->bindValue(':email', $mail['email']);
	$pdoStatement->execute();
	
}

if($pdoStatement === false){

	$insAll = 
			'
			INSERT INTO
				  student
				  (
				    stu_name,
				    stu_firstname ,
				    stu_birthdate ,
				    stu_email,
				    stu_sex,
				    stu_with_experience ,
				    stu_is_leader
				  )
				  VALUES(
				   :name,
				   :firstname,
				   :birthdate,
				   :email,
				   :sex,
				   :with_experience,
				   :is_leader
				)
			';

	$pdoStatement = $pdo->prepare($insAll);

	foreach ($studentsList as $key => $value) {

		foreach ($value as $keyTwo => $valueTwo) {
			
			$pdoStatement->bindValue(':'.$keyTwo, $valueTwo);
		}
		
		$pdoStatement->execute();

	}
	
}