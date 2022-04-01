<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./vues/css/styleTab.css">
  <title>Document</title>
</head>


<!-- <table>
  <thead align="left" style="display: table-header-group">
  <tr>
     <th>Professeur</th>
     <th>Instrument</th>
     <th>Le jour, Date</th>
     <th>Place</th>
  </tr>
  </thead>
<tbody>
<?php 

foreach ($lesCours as $cours) :?>
  <tr class="item_row">
        <td> <?php echo $cours[0]; ?></td>
        <td> <?php echo $cours[1]; ?></td>
        <td> <?php echo $cours[2]; ?></td>
        <td> <?php echo $cours[3]; ?></td>
  </tr>
<?php endforeach;?>
</tbody>
</table> -->

<table class="container">
	<thead>
		<tr>
			<th><h1>Professeur</h1></th>
			<th><h1>Instrument</h1></th>
			<th><h1>Le jour, Date</h1></th>
			<th><h1>Place</h1></th>
      <th><h1>Inscription</h1></th>
		</tr>
	</thead>
	<tbody>
  <?php 
    foreach ($lesCours as $cours) :?>
      <tr class="item_row">
            <td> <?php echo $cours[0]; ?></td>
            <td> <?php echo $cours[1]; ?></td>
            <td> <?php echo $cours[2]; ?></td>
            <td> <?php echo $cours[3]; ?></td>
            <td>Inscription</td>
      </tr>
    <?php endforeach;?>
		</tr>
	</tbody>
</table>