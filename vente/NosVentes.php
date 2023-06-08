<?php
session_start();
include('includes/config.php');
$bdd = pdo_connect_mysql();
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Carrom| Nos vehicules de vente</title>
     <?php include 'includes/css.php'; ?>
</head>

<body>
     <?php include 'includes/header.php'; ?>
     <?php include 'includes/menu_barre.php'; ?>
     <section class="section-padding pt-0">
          <div class="container-fluid">
               <div class="testimonial-slider row">
                    <?php $sql = "SELECT img1, id_vehi from  vehicule where statut='Vendre' LIMIT  4 ";
                    $query = $bdd->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                         foreach ($results as $result) { ?>
                              <div class="slide-item px-3">
                                   <div class="testimonial_bloc">
                                        <div class="testimonial_comment">
                                             <a href="details_vente.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>">
                                                  <img src="../admin/img/voitureimages/<?php echo htmlentities($result->img1) ?>" alt="img" width="700" height="400">
                                             </a>
                                        </div>
                                   </div>
                              </div>
                    <?php }
                    } ?>
               </div>
               <div class="testimonial-slider row">
                    <?php $sql = "SELECT img1,id_vehi from  vehicule where statut='Vendre'  ORDER BY id_vehi DESC  LIMIT 5 OFFSET 4";
                    $query = $bdd->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                         foreach ($results as $result) { ?>
                              <div class="slide-item px-3">
                                   <div class="testimonial_bloc">
                                        <div class="testimonial_comment">
                                             <a href="details_vente.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>">
                                                  <img src="../admin/img/voitureimages/<?php echo htmlentities($result->img1) ?>" alt="img" width="700" height="400">
                                             </a>
                                        </div>
                                   </div>
                              </div>
                    <?php }
                    } ?>
               </div>
               <div class="testimonial-slider row">
                    <?php $sql = "SELECT img1, id_vehi from  vehicule where statut='Vendre' LIMIT 4 OFFSET 8 ";
                    $query = $bdd->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                         foreach ($results as $result) { ?>
                              <div class="slide-item px-3">
                                   <div class="testimonial_bloc">
                                        <div class="testimonial_comment">
                                             <a href="details_vente.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>">
                                                  <img src="../admin/img/voitureimages/<?php echo htmlentities($result->img1) ?>" alt="img" width="700" height="400">
                                             </a>
                                        </div>
                                   </div>
                              </div>
                    <?php }
                    } ?>
               </div>
          </div>
     </section>
     <?php include 'includes/footer.php'; ?>
     <script data-cfasync="false" src="../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
     </script>
     <script src="../assets/js/plugins/jquery-3.6.0.min.js"></script>
     <script src="../assets/js/plugins/bootstrap.bundle.min.js"></script>
     <script src="../assets/js/plugins/slick.min.js"></script>
     <script src="../assets/js/plugins/jquery.magnific-popup.min.js"></script>
     <script src="../assets/js/plugins/jquery.counterup.min.js"></script>
     <script src="../assets/js/plugins/jquery.inview.min.js"></script>
     <script src="../assets/js/custom.js"></script>
</body>

</html>