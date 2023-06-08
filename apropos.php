<?php
session_start();
include('includes/config.php');
$bdd = pdo_connect_mysql();
error_reporting(0);

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    $insert = $bdd->prepare('INSERT INTO contact (`nom`, `emailid`, `telephone`, `message`)
         VALUES (?,?,?,?)');
    $insert->execute(array($nom, $email, $tel, $msg));
    if ($insert) {
        echo "<script>alert('Le message est envoyé avec succès');</script>";
    } else {
        echo "<script>alert('Une erreur s'est produite');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Carrom ||Contact</title>
    <?php include 'includes/css.php'; ?>
</head>
 
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/menu_barre.php'; ?>
  <div class="container">
    <div class="row">
      <div class="info col-md-6">
      <h1>CAR<span style="color:#ff4321">-R</span>OOM&#63;</h1>
      <p style="text-align: justify;letter-spacing: 3px;">
        Est un espace qui met en relation les clients,<br />

        les utilisateurs et l'agence de location de vehicules<br />
        <br />
        Si vous êtes à la recherche d'un vehicule a louer ou acheter, <br />
        vous pouvez vous rendre auprès de notre site web <br />
        en accédant à l'un de ces liens &#8681;.
        <br />
      </p>

    </div> 
    <div class="col-md-6 py-5">
          <div class="img-box ">
      <img style="opacity:1;" src="admin/img/voitureimages/2018-aurus-senat (1).jpg">
    </div>
    </div>   
    <div class="col-2">
          <a href="louer.php" role="button"><span style="color:#dd4326">
          <h3>Louer&raquo;</h3>
        </span></a>
    </div>
 Ou
 <div class="col">
        <a href="louer.php" role="button"><span style="color:#dd4326">
          <h3>Acheter&raquo;</h3>
        </span></a>
 </div>

    </div>

  </div>
      <?php include 'includes/footer.php'; ?>
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/plugins/jquery-3.6.0.min.js"></script>
    <script src="assets/js/plugins/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.counterup.min.js"></script>
    <script src="assets/js/plugins/jquery.inview.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>