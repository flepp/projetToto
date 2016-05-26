
<h3>
	<?= $etudiantListe['stu_name'] ?>
	<?= $etudiantListe['stu_firstname'] ?>
	<span>Identifiant : <?= $etudiantListe['stu_id'] ?></span>
</h3>

<ul class="infos">
		
		<li>Ville : <?= $etudiantListe['cit_name'] ?></li>
		<li>Nationalité  : <?= $etudiantListe['cou_name'] ?></li>
		<li>Statut Marital: <?= $etudiantListe['mar_name'] ?></li>
		<li>Date de naissance : <?= $etudiantListe['stu_birthdate'] ?></li>
		<li>Email : <?= $etudiantListe['stu_email'] ?></li>

		<li>Session : <?= $etudiantListe['ses_id'] ?></li>
		<li>Sexe : <?= $etudiantListe['stu_sex'] ?></li>
		<li>Expérience : <?= $etudiantListe['stu_with_experience'] ?></li>
		<li>Leader : <?= $etudiantListe['stu_is_leader'] ?></li>
		<li>Signe Astrologique : <?= $tradFr[$zodiacSign] ?></li>

</ul>