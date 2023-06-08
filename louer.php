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
     <title>Carrom || Location</title>
     <?php include 'includes/css.php'; ?>
</head>

<body>

     <?php include 'includes/header.php'; ?>
     <?php include 'includes/menu_barre.php'; ?>


     <div class="banner">
          <div class="banner_slider">
               <?php $sql = "SELECT * from  vehicule  where  statut = 'louer'  order by date_ajout  desc limit 5 ";
               if (isset($_GET['recherche']) and !empty($_GET['recherche'])) {
                    $recherche = htmlspecialchars($_GET['recherche']);
                    $sql = "SELECT * FROM vehicule WHERE statut='louer' and  nom or marque LIKE '%" . $recherche . "%' ORDER BY date_ajout desc";
               }
               $query = $bdd->prepare($sql);
               $query->execute();
               $results = $query->fetchAll(PDO::FETCH_OBJ);
               $cnt = 1;

               if ($query->rowCount() > 0) {
                    foreach ($results as $result) {                    ?>

                         <div class="slide-item" style="background-image: url(admin/img/voitureimages/<?php echo htmlentities($result->img1); ?>">
                              <div class="section-padding">
                                   <div class="container-fluid">
                                        <div class="banner_content">
                                             <h1 class="title">Les meilleurs voiture de location sont ici !!!</h1>
                                             <p class="text">Louez on accorde <br>
                                                  <strong>20%</strong>
                                                  de reduction
                                             </p>
                                             <a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>" class="thm-btn btn-rouded thm-bg-color-one">Louer maintenant <i class="fal fa-long-arrow-right"></i></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
               <?php $cnt = $cnt + 1;
                    }
               } ?>
          </div>
     </div>
     <section class="section-padding pt-0">

          <div class="container-fluid">
               <div>
                    <h3 class="title">les voitures</h3>
                    <p class="text">Les meilleures voitures de location pour votre confort qui sont d'état neufs!!!</p>
               </div>
               <div class="vegetables-slider row">

                    <?php $sql = "SELECT * from  vehicule  where statut = 'louer'  order by date_ajout  desc ";
                    if (isset($_GET['recherche']) and !empty($_GET['recherche'])) {
                         $recherche = htmlspecialchars($_GET['recherche']);
                         $sql = "SELECT * FROM vehicule WHERE nom  LIKE '%" . $recherche . "%' ORDER BY date_ajout desc";
                    }
                    $query = $bdd->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;

                    if ($query->rowCount() > 0) {
                         foreach ($results as $result) {                    ?>
                              <div class="slide-item px-3">
                                   <div class="product_block">

                                        <div class="product_image">
                                             <a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>">
                                                  <img src="admin/img/voitureimages/<?php echo htmlentities($result->img1); ?>" class="image-fit-contain" alt="img">
                                             </a>
                                        </div>
                                        <div class="product_categories">
                                             <a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>"><?php echo htmlentities($result->marque); ?></a>
                                        </div>
                                        <h4 class="title">
                                             <a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>"><?php echo htmlentities($result->nom); ?></a>
                                        </h4>
                                        <div class="price">
                                             <span><?php echo htmlentities($result->prixparjour); ?></span><small>fcfa/jour</small>
                                        </div>
                                        <div class="product_qty">
                                             <span><?php echo htmlentities($result->kilometrage); ?></span>/H
                                        </div>
                                        <div class="product_action">
                                             <button type="button" class="product_btn" style=" background-color: #007FFF;">
                                                  <a href="details.php?id_vehi=<?php echo $result->id_vehi; ?>" style="color: #FFF;"><i class="fa fa-plus"></i> Details</a>
                                             </button>
                                        </div>
                                   </div>
                              </div>

                    <?php $cnt = $cnt + 1;
                         }
                    } ?>

               </div>
          </div>
     </section>
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