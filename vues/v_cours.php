<table>
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
</table>
