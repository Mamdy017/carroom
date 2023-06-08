<?php
if (isset($_POST['envoyer'])) {

     if (empty($_POST['email'])) {
          $valid = 0;
          echo "<script>alert('le mail nest pas valide')</script>";
     } else {
          if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
               $valid = 0;
               echo "<script>alert('le mail n'est pas valide')</script> ";
          } else {
               $statement = $bdd->prepare("SELECT * FROM abonnee WHERE email=?");
               $statement->execute(array($_POST['email']));
               $total = $statement->rowCount();
               if ($total) {
                    $valid = 0;
                    echo "<script>alert('Cet email existe déjà')</script>";
               } else {
                    // Sending email to the requested subscriber for email confirmation
                    // Getting activation key to send via email. also it will be saved to database until user click on the activation link.
                    $key = md5(uniqid(rand(), true));

                    // Inserting data into the database
                    $statement = $bdd->prepare("INSERT INTO abonnee (email,statut) VALUES (?,?)");
                    $statement->execute(array($_POST['email'], $key));

                    // Sending Confirmation Email
                    // $to = $_POST['email'];
                    // 	$subject = 'Confirmation du mail';

                    // Getting the url of the verification link
                    // $verification_url = BASE_URL.'verify.php?email='.$to.'&key='.$key;

                    // $message = '';

                    // $headers = 'From: ' . $contact_email . "\r\n" .
                    // 	   'Reply-To: ' . $contact_email . "\r\n" .
                    // 	   'X-Mailer: PHP/' . phpversion() . "\r\n" . 
                    // 	   "MIME-Version: 1.0\r\n" . 
                    // 	   "Content-Type: text/html; charset=ISO-8859-1\r\n";

                    // Sending the email
                    // mail($to, $subject, $message, $headers);

                    echo "<script>alert('Abonnement effectue avec succes')</script>";
               }
          }
     }
}
?>
<?php if ($_SESSION['login']) { ?>
     <section class="section section-bg relative newsletter_bg">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-xl-5">
                         <div class="newsletter_text">
                              <form action="#" method="POST">
                                   <div class="input-group">
                                        <span class="input-group-text">
                                             <i class="fal fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Email Address" autocomplete="off" name="email">
                                        <div class="input-group-append">
                                             <button class="thm-btn thm-bg-color-one" type="submit" name="envoyer">S'abonnée</button>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>
<?php } ?>
<footer class="footer section-padding border-top">
     <div class="container-fluid">
          <div class="row">
               <div class="col-xl-1 col-sm-4">
               </div>
               <div class="col-xl-2 col-sm-4">
                    <div class="ft_widget border-sm-0 pl-sm-0">
                         <h6 class="ft_title">Galeries</h6>
                         <p class="mb-2">Nous suivre:</p>
                    </div>
               </div>
               <div class="col-xl-2 col-sm-4">
                    <div class="ft_widget">
                         <h6 class="ft_title">Besoin d'aide?</h6>
                         <ul class="ft_menu">
                              <li>
                                   <a href="Apropos.php">A propos de nous</a>
                              </li>
                              <li>
                                   <a href="conseil.php">conseils</a>
                              </li>
                         </ul>
                    </div>
               </div>
               <div class="col-xl-2 col-sm-4">
                    <div class="ft_widget">
                         <h6 class="ft_title">Principal</h6>
                         <ul class="ft_menu">
                              <li>
                                   <a href="index.php">Accueil</a>
                              </li>
                              <li>
                                   <a href="connexion.php">Connexion</a>
                              </li>
                         </ul>
                    </div>
               </div>
               <div class="col-xl-2 col-sm-4">
                    <div class="ft_widget">
                         <h6 class="ft_title">Nous contactez</h6>
                         <p class="mb-3"> </p>
                         <ul class="ft_contact">

                              <li>
                                   <a href="contact.php">Contact</a>
                              </li>
                         </ul>
                    </div>
               </div>
               <div class="col-xl-2 col-sm-4">
                    <div class="ft_widget">
                         <h6 class="ft_title">Categories</h6>
                         <ul class="ft_menu">
                              <li>
                                   <a href="louer.php">Location</a>
                              </li>
                              <li>
                                   <a href="vente/vente.php">Vente</a>
                              </li>
                         </ul>
                    </div>
               </div>
          </div>
     </div>
</footer>

<div class="copyright">
     <div class="container-fluid">
          <p class="mb-0">Copyright © 2022. carroom@gmail.com.</p>
     </div>
</div>