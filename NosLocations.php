<?php 
session_start();
include('includes/config.php');
$bdd= pdo_connect_mysql();
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Carrom| Nos vehicules de location</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="Description website">
     <meta name="author" content="Maksym Blank">
     <meta name="keywords" content="website, with, meta, tags">
     <meta name="robots" content="noindex, follow">
     <meta name="revisit-after" content="5 month">
     <meta name="image" content="https://ownwebsite.com/">
     <meta name="og:title" content="Title website">
     <meta name="og:description" content="Description website">
     <meta name="og:image" content="https://ownwebsite.com/">
     <meta name="og:site_name" content="My Website">
     <meta name="og:type" content="website">
     <meta name="twitter:card" content="summary">
     <meta name="twitter:title" content="Title website">
     <meta name="twitter:description" content="Description website">

     <link rel="icon" type="image/png" sizes="32x32" href="favicon.ico">
     <link href="assets/css/plugins/bootstrap.min.css" rel="stylesheet">
     <link href="assets/fonts/font-awesome.min.css" rel="stylesheet">
     <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
     <link href="assets/css/plugins/slick.css" rel="stylesheet">
     <link href="assets/css/stylee.css" rel="stylesheet">
     <link href="assets/css/responsive.css" rel="stylesheet">
     <link rel="shortcut icon" href="assets/images/icon/favicon.png">
</head>
<body>
     <?php include'includes/header.php' ;?>
     <?php include'includes/menu_barre.php' ;?>
     <section class="section-padding pt-0">
          <div class="container-fluid">
               <div class="testimonial-slider row">
                    <?php $sql = "SELECT img1, id_vehi from  vehicule where statut='Louer' LIMIT  5 ";
                         $query = $bdd -> prepare($sql);
                         $query->execute();
                         $results=$query->fetchAll(PDO::FETCH_OBJ);
                         $cnt=1;
                         if($query->rowCount() > 0)
                         {
                              foreach($results as $result)
                         {?>
                         <div class="slide-item px-3">
                              <div class="testimonial_bloc">
                                   <div class="testimonial_comment">
                                        <a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi);?>">
                                             <img src="admin/img/voitureimages/<?php echo htmlentities($result->img1) ?>"
                                             alt="img" width="700" height="400">
                                        </a>
                                   </div>
                              </div>
                         </div>   
                    <?php }} ?>
               </div>
               <div class="testimonial-slider row">
                    <?php $sql = "SELECT img1,id_vehi from  vehicule where statut='Louer'  ORDER BY id_vehi DESC  LIMIT 5 OFFSET 5";
                         $query = $bdd -> prepare($sql);
                         $query->execute();
                         $results=$query->fetchAll(PDO::FETCH_OBJ);
                         $cnt=1;
                         if($query->rowCount() > 0)
                         {
                              foreach($results as $result)
                         {?>
                         <div class="slide-item px-3">
                              <div class="testimonial_bloc">
                                   <div class="testimonial_comment">
                                        <a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi);?>">
                                             <img src="admin/img/voitureimages/<?php echo htmlentities($result->img1) ?>"
                                             alt="img" width="700" height="400">
                                        </a>
                                   </div>
                              </div>
                         </div>
                    <?php }} ?>
               </div>
               <div class="testimonial-slider row">
                    <?php $sql = "SELECT img1, id_vehi from  vehicule where statut='Louer' LIMIT 4 OFFSET 8 ";
                         $query = $bdd -> prepare($sql);
                         $query->execute();
                         $results=$query->fetchAll(PDO::FETCH_OBJ);
                         $cnt=1;
                         if($query->rowCount() > 0)
                         {
                              foreach($results as $result)
                         {?>
                         <div class="slide-item px-3">
                              <div class="testimonial_bloc">
                                   <div class="testimonial_comment">
                                        <a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi);?>">
                                             <img src="admin/img/voitureimages/<?php echo htmlentities($result->img1) ?>"
                                             alt="img" width="700" height="400">
                                        </a>
                                   </div>
                              </div>
                         </div>
                    <?php }} ?>
               </div>
          </div>
     </section>
     <?php include'includes/footer.php' ;?>
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
</html>
