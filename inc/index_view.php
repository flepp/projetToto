
	<h3>Sessions à Esch Belval</h3>

	<ul>

		<?php foreach ($sesList as $key => $value): ?>
			<li> 
				<a href="list.php?ses_id=<?= $value['ses_id'] ?>">
					Session <?= $value['ses_id'] ?> : <?=  $value['ses_opening']  ?> au <?=  $value['ses_ending']  ?>
				</a>
			</li>
		<?php endforeach ?>
		
	</ul>

	<table>
			<h3>Etudiants par ville</h3>
			<tr>
				<td>Nombre Etudiants</td>
				<td>Ville</td>
			</tr>
		
		<?php foreach ($stuNbCit as $key => $value) : ?>
			<tr>
				<td><?= $value['nb'] ?> </td>
				<td><a href="search.php?search=<?=$value['cit_name']?>"><?= $value['cit_name'] ?></a> </td>
			</tr>
		<?php endforeach ?>
		
	</table>

	<table>
				<h3>Etudiants par pays</h3>
			<tr>
				<td>Nombre Etudiants</td>
				<td>Pays</td>
			</tr>
		
		<?php foreach ($stuNbCou as $key => $value) : ?>
			<tr>
				<td><?= $value['nb'] ?> </td>
				<td><a href="search.php?search=<?=$value['cou_name']?>"><?= $value['cou_name'] ?></a> </td>
			</tr>
		<?php endforeach ?>
		
	</table>