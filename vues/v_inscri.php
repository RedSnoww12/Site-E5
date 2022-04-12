<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./vues/css/styleTab.css">
  <?php 
    require_once("./model/Person.php");
    require_once("./model/Teacher.php");
    require_once("./model/Student.php");
    require_once("./model/Instrument.php");
    require_once("./model/Cours.php"); ?>
</head>


<table class="container">
	<thead>
		<tr>
			<th><h1>Nom</h1></th>
			<th><h1>Prenom</h1></th>
			<th><h1>Payé</h1></th>
			<th><h1>Cours</h1></th>

		</tr>
	</thead>
	<tbody>
  <?php 
    foreach ($tableInscri as $studentI) :?>
      <?php foreach ($studentI as $inscri) :?>
      <tr class="item_row">
            <td> <?php echo $inscri->getPersonNom(); ?></td>
            <td> <?php echo $inscri->getPersonPrenom(); ?></td>
            <td> <?php echo $inscri->getPayee(); ?></td>
            <td> <?php echo $inscri->getIdCours(); ?></td>
      </tr>
      <?php endforeach;?>
    <?php endforeach;?>
		</tr>
	</tbody>
</table>