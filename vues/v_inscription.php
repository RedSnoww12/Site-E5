<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vues/css/styleInscription.css">
</head>

<?php 
    if (isset($_GET['idCours'])) {
        $idCours = $_GET['idCours'];
    }
?>


<div class="containerInscription">  
  <form id="contact" action="./index.php?action=inscriptionSucced&idCours=<?php echo $idCours?>" method="post">
    <h3>Inscription Cours</h3>
    <h4>Inscription pour le cours : <?php echo $idCours?></h4>
    <fieldset>
      <input placeholder="Your First Name" type="text" name="nom" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Your Last Name" type="text" name="prenom" tabindex="2" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Your Email Address" type="email" name="email" tabindex="3" required>
    </fieldset>
    <fieldset>
      <input placeholder="Your Phone Number" type="tel" name="telephone" tabindex="4" required>
    </fieldset>
    <fieldset>
      <input placeholder="Your Adresse" type="text" name="adresse" tabindex="5" required>
    </fieldset>
    <fieldset>
      <textarea placeholder="Type your message here...." tabindex="6"></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
</div>

