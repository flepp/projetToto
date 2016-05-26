<h3>Liste des étudiants</h3>
<!--<p>Choisissez le nombre d'étudiants à afficher</p>-->

<?php 

	if(!empty($usrVal)){

		echo $msgSearch;

	}

?>

<?php if (isset($etudiantListe) && sizeof($etudiantListe) > 0) : ?>
<table>
	<thead>
		<tr>
			<td>Nom</td>
			<td>Prénom</td>
			<td>Email</td>
			<td>Ville</td>
			<td>Nationalité</td>
			<td>Statut marital</td>
			<td>Date de naissance</td>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($etudiantListe as $currentEtudiant) : ?>
		<tr>
			<td><a href="student.php?stu_id=<?= $currentEtudiant['stu_id']?>"><?= $currentEtudiant['stu_name'] ?></a></td>
			<td><a href="student.php?stu_id=<?=$currentEtudiant['stu_id']?>"><?= $currentEtudiant['stu_firstname'] ?></a></td>
			<td><?= $currentEtudiant['stu_email'] ?></td>
			<td><?= $currentEtudiant['cit_name'] ?></td>
			<td><?= $currentEtudiant['cou_name'] ?></td>
			<td><?= $currentEtudiant['mar_name'] ?></td>
			<td><?= $currentEtudiant['birthdate'] ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<!--pagination-->

<div class="pagination">
	<!--<?php if($currentOff !== 0) { ?> -->
	
	<!--<a href="list.php?ses_id=<?= $sesId ?>&offset=<?=($currentOff-$nbPerPage) ?>">Précedent</a>
	-->
	<!--<?php } ?> -->
	<!-- <a href="list.php?ses_id=<?= $sesId ?>&offset=<?=($currentOff+$nbPerPage) ?>">Suivant</a>-->
	<?php
		
	if(isset($sesId)){
		
		if($currentPage !== 1) { 

	?>
			<a href="list.php?ses_id=<?= $sesId ?>&page=<?=($currentPage-1) ?>">Précedent</a>

	<?php } ?>

		<a href="list.php?ses_id=<?= $sesId ?>&page=<?=($currentPage+1) ?>">Suivant</a>

	<?php } ?>

</div>
<?php else :?>
aucun étudiant
<?php endif; ?>