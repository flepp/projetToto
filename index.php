<?php 

    require 'inc/db.php';

	$sql='

		SELECT 
			ses_opening, 
			ses_ending,
			ses_id
		FROM 
			session
		';

	$pdoStatement = $pdo->query($sql);

	if($pdoStatement === false){

		print_r($pdo->errorInfo());
	}

	else{

		$sesList = $pdoStatement->fetchAll();

	}

	$stuNbCit = array();

	$stuQueryCit = '
				
				SELECT COUNT(*) AS nb,
				  city.cit_name
				FROM
				  student
				INNER JOIN
				  city ON city.cit_id = student.cit_id
				GROUP BY
				  cit_name
				ORDER BY nb DESC
	';

	$pdoStatement = $pdo->query($stuQueryCit);

	if($pdoStatement === false){

		print_r($pdo->errorInfo());
	}

	else if($pdoStatement->rowCount() > 0){

		$stuNbCit = $pdoStatement->fetchAll();

	}

	$stuNbCou = array();

	$stuQueryCou = '
				
				SELECT COUNT(*) AS nb,
				  country.cou_name
				FROM
				  student
				INNER JOIN
				  country ON country.cou_id = student.cou_id
				GROUP BY
				  cou_name
				ORDER BY nb DESC
	';

	$pdoStatement = $pdo->query($stuQueryCou);

	if($pdoStatement === false){

		print_r($pdo->errorInfo());
	}

	else if($pdoStatement->rowCount() > 0){

		$stuNbCou = $pdoStatement->fetchAll();

	}
	
	require 'inc/header.php';
	require 'inc/menu.php'; 
	require 'inc/index_view.php';
	require 'inc/footer.php'; 

 ?>
