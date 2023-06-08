<?php
session_start();
include('includes/config.php');
$bdd = pdo_connect_mysql();
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">

<!-- Mirrored from themes.codezion.com/tm/html/wuud/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Jan 2022 01:12:05 GMT -->

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Carrom || Accueil</title>
     <?php include 'includes/css.php'; ?>

</head>

<body>
     <?php include 'includes/header.php'; ?>
     <?php include 'includes/menu_barre.php'; ?>
     <div class="banner">
          <div class="banner_slider">
               <div class="slide-item max" style="background-image: url(assets/images/index/R.jpg);">
                    <div class="section-padding">
                         <div class="container-fluid">
                              <div class="banner_content">
                                   <h1 class="title">Bienvenue sur  Carrom le meilleur site de reservation de vehicule</h1>
                                   <a href="louer.php" class="thm-btn btn-rounded thm-bg-color-one"> vehicules à louer
                                        <i class="fal fa-long-arrow-right"></i>
                                   </a>
                                   <a href="vente/vente.php" class="thm-btn btn-rounded thm-bg-color-one">Vehicules à vendre
                                        <i class="fal fa-long-arrow-right"></i>
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <?php include 'includes/footer.php'; ?>
     <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
     </script>
     <script src="assets/js/plugins/jquery-3.6.0.min.js"></script>
     <script src="assets/js/plugins/bootstrap.bundle.min.js"></script>
     <script src="assets/js/plugins/slick.min.js"></script>
     <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
     <script src="assets/js/plugins/jquery.counterup.min.js"></script>
     <script src="assets/js/plugins/jquery.inview.min.js"></script>
     <script src="assets/js/custom.js"></script>
</body>

<!-- Mirrored from themes.codezion.com/tm/html/wuud/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Jan 2022 01:13:46 GMT -->

</html>
<style>
     @media screen and (max-width: 428px) {
          .max {

               width: 10px;
               height: 650px;
          }

          h3 {

               font-size: 1.2em;
               display: inline;
          }
     }
</style>