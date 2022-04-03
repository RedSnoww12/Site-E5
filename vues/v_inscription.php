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
  <form id="contact" action="" method="post">
    <h3>Inscription Cours</h3>
    <h4>Contact us for custom quote</h4>
    <fieldset>
      <input placeholder="Your First Name" type="text" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Your Last Name" type="text" tabindex="2" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Your Email Address" type="email" tabindex="3" required>
    </fieldset>
    <fieldset>
      <input placeholder="Your Phone Number" type="tel" tabindex="4" required>
    </fieldset>
    <fieldset>
      <input placeholder="Your Web Site (optional)" type="url" tabindex="5" required>
    </fieldset>
    <fieldset>
      <textarea placeholder="Type your message here...." tabindex="6" required></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
    <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a></p>
  </form>
</div>

