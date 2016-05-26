<?php 

 	require 'inc/db.php';

 	if(!empty($_GET['stu_id'])){

		$stuId = intval($_GET['stu_id']);

		$sql='

			SELECT 
				*
			FROM 
				student
			LEFT OUTER JOIN
					country ON country.cou_id = student.cou_id
			LEFT OUTER JOIN
					city ON city.cit_id = student.cit_id
			LEFT OUTER JOIN 
					marital_status ON marital_status.mar_id = student.mar_id
			WHERE
				stu_id = :stuId

			';

			$pdoStatement = $pdo->prepare($sql);

			$pdoStatement->bindValue(':stuId',$stuId, PDO::PARAM_INT);

			if($pdoStatement->execute() === false){

				print_r($pdo->errorInfo());
			}

			else if ($pdoStatement->rowCount() > 0){

				$etudiantListe = $pdoStatement->fetch();

			}

			/* script pour la traduction des signes astrologiques */

			$dateFDB = $etudiantListe['stu_birthdate'];
			$stuBD = intval(substr($dateFDB, 8, 2));
			$stuBM = intval(substr($dateFDB, 5, 2));

			require_once __DIR__.'/vendor/autoload.php';
	
			$calculator = new \Whatsma\ZodiacSign\Calculator();

			try {

				$zodiacSign = $calculator->calculate($stuBD,$stuBM);

			  	$tradFr = array(

			  		'aries' => 'bélier',
			  		'taurus' => 'taureau',
			  		'cancer' => 'cancer',
			  		'aquarius' => 'verseau',
			  		'capricorn' => 'capricorne',
			  		'gemini' => 'gemeaux',
			  		'leo' => 'lion',
			  		'virgo' => 'vierge',
			  		'libra' => 'balance',
			  		'scorpio' => 'scorpion',
			  		'sagittarius' => 'sagittaire',
			  		'pisces' => 'poisson'

				);

			} catch (ZodiacSign\InvalidDayException $e) {
			  echo "ERROR: Invalid Day";
			} catch (ZodiacSign\InvalidMonthException $e) {
			  echo "ERROR: Invalid Month";
			}

			/* fin */
	}

	require 'inc/header.php';
	require 'inc/menu.php';
	require 'inc/student_view.php';
	require 'inc/footer.php';
 ?>