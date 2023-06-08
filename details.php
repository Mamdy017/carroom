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
     <title>Carrom| Details</title>
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





     <?php include 'includes/header.php'; ?>
     <?php include 'includes/menu_barre.php'; ?>







     <section class="section-padding pt-0">
          <?php


          // Vérifiez si le paramètre id est spécifié dans l'URL.  
          if (isset($_GET['id_vehi'])) {
               // Pour éviter toute injection SQL, préparez l'instruction et exécutez-la.  
               $stmt = $bdd->prepare('SELECT nom ,prixparjour as bid, quantite, id_vehi, prixparjour, etat_vehicule, marque,annee_modele, carburant, kilometrage,img1,img2,img3,img4,img5,air_conditionner,lecteur_cd,porte_electrique,systeme_freinage,assistant_freinage,direction_assistee,airbag_chauffeur,airbag_passager,fermeture_central,capteur_collision,systeme_freinage,assistant_freinage,vitres_electrique FROM vehicule WHERE id_vehi = ?');
               $stmt->execute([$_GET['id_vehi']]);
               /*  Récupérer le produit de la base de données et retourner le résultat sous forme de tableau.*/
               $produit = $stmt->fetch(PDO::FETCH_ASSOC);
               $_SESSION['nom'] = $produit['bid'];
               $_SESSION['id_vehi'] = $produit['id_vehi'];
               /* Vérifiez si le produit existe (le tableau n'est pas vide)*/
               if (!$produit) {
                    /*Erreur simple à afficher si l'id du produit n'existe pas (le tableau est vide)*/
                    exit('le produit n\'existe pas!');
               }
          } else {
               //  Erreur simple à afficher si l'id n'a pas été spécifié.  
               exit('le produit n\'existe pas!');
          }
          ?>
          <div class="container-fluid">

               <div class="testimonial-slider row">

                    <div class="slide-item px-3">
                         <div class="testimonial_bloc">
                              <div class="testimonial_comment">
                                   <img src="admin/img/voitureimages/<?= $produit['img1'] ?>" alt="img" width="700" height="400">
                              </div>

                         </div>
                    </div>

                    <div class="slide-item px-3">
                         <div class="testimonial_bloc">
                              <div class="testimonial_comment">
                                   <img src="admin/img/voitureimages/<?= $produit['img2'] ?>" alt="img" width="700" height="400">
                              </div>

                         </div>
                    </div>

                    <div class="slide-item px-3">
                         <div class="testimonial_bloc">
                              <div class="testimonial_comment">
                                   <img src="admin/img/voitureimages/<?= $produit['img3'] ?>" alt="img" width="700" height="400">
                              </div>

                         </div>
                    </div>

                    <div class="slide-item px-3">
                         <div class="testimonial_bloc">
                              <div class="testimonial_comment">
                                   <img src="admin/img/voitureimages/<?= $produit['img4'] ?>" alt="img" width="700" height="400">
                              </div>

                         </div>
                    </div>

                    <div class="slide-item px-3">
                         <div class="testimonial_bloc">
                              <div class="testimonial_comment">
                                   <img src="admin/img/voitureimages/<?= $produit['img5'] ?>" alt="img" width="700" height="400">
                              </div>

                         </div>
                    </div>

               </div>
          </div>
          <div class="row" style="position:center; margin-top: 1.4rem; ">



               <div class=" col-sm-9">

                    <div class="main">
                         <style>
                              .bor {
                                   list-style-type: none;
                                   height: 180px;
                                   border-radius: 20px;
                                   border: 1px solid #ddd;
                              }

                              .signup {
                                   position: relative;
                                   width: 100%;
                                   height: 100%;
                              }

                              #chk {
                                   display: none;
                              }

                              label {
                                   color: #fff;
                                   font-size: 2em;
                                   justify-content: center;
                                   display: flex;
                                   margin: 55px;
                                   font-weight: bold;
                                   cursor: pointer;
                                   transition: .7s ease-in-out;
                              }

                              .login {
                                   height: 400px;
                                   background: #fff;
                                   transform: translateY(-90px);
                                   transition: .8s ease-in-out;
                                   overflow: scroll;
                              }

                              .et {
                                   width: 75%;
                                   height: 30px;
                                   justify-content: center;
                                   margin: 20px auto;
                              }

                              .c {
                                   color: black;
                              }

                              .i {
                                   font-size: 3em;
                                   color: #00a8ff;
                                   margin-left: 7px;

                              }

                              .i2 {
                                   font-size: 3em;
                                   color: #00a8ff;
                                   margin-left: 12px;

                              }

                              .a1 {
                                   margin-left: 15px;
                              }

                              .p {
                                   color: red;
                                   width: 85%;
                                   height: 22px;
                                   justify-content: center;
                                   margin: 20px auto;
                              }

                              .login label {
                                   color: #573b8a;
                                   transform: scale(.6);
                              }

                              #chk:checked~.login {
                                   transform: translateY(-500px);
                              }

                              #chk:checked~.login label {
                                   transform: scale(1);
                              }

                              #chk:checked~.signup label {
                                   transform: scale(.6);
                              }

                              .main {
                                   height: 435px;
                                   overflow: hidden;


                              }








                              @media (max-width: 1199px) {

                                   .main {

                                        height: 500px;
                                        overflow: hidden;
                                   }

                                   .bor {
                                        list-style-type: none;
                                        height: 180px;
                                        width: 90px;
                                        border-radius: 20px;
                                        border: 1px solid #ddd;
                                   }

                                   .i {
                                        color: #00a8ff;
                                        height: 20px;
                                        font-size: 2em;
                                        margin-left: 2px;
                                   }

                                   .ii {
                                        color: #00a8ff;
                                        height: 15px;
                                        font-size: 2em;
                                        margin-left: 5px;
                                   }

                                   .i2 {
                                        color: #00a8ff;
                                        height: 10px;
                                        font-size: 2em;
                                        margin-left: 2px;
                                   }

                                   .c {
                                        height: 200px;
                                        font-size: 1em;
                                        margin-left: 1px;

                                   }

                                   .p {
                                        color: red;
                                        height: 10px;
                                        margin-left: 1px;
                                        font-size: 0.8em;
                                   }

                                   .et {
                                        width: 100%;
                                        height: 10px;
                                        justify-content: center;
                                        margin: 10px auto;
                                   }

                              }

                              .sidebar_widget {
                                   padding: 20px 14px 20px;
                              }

                              .sidebar_widget {
                                   border: 1px solid #e6e6e6;
                                   margin: 0 auto 40px;
                                   padding: 20px 16px 30px;
                                   position: relative;
                              }

                              .form-group {
                                   margin-bottom: 15px;
                                   position: relative;
                              }

                              .group {
                                   margin-bottom: 15px;
                                   position: relative;
                                   color: black;
                                   text-decoration: uppercase;
                              }

                              .form-control {
                                   background: #eeeeee none repeat scroll 0 0;
                                   border: 0 none;
                                   border-radius: 3px;
                                   box-shadow: none;
                                   color: #888888;
                                   font-size: 15px;
                                   height: 46px;
                                   line-height: 30px;
                                   padding: 0 15px;
                              }

                              .form-control:hover,
                              .form-control:focus {
                                   box-shadow: none;
                                   outline: none
                              }


                              @media (max-width: 767px) {

                                   .main {

                                        height: 500px;
                                        overflow: hidden;
                                   }

                                   .bor {
                                        list-style-type: none;
                                        height: 150px;
                                        width: 70px;

                                        border: 1px solid #ddd;
                                   }

                                   .i {
                                        color: #00a8ff;
                                        height: 20px;
                                        font-size: 2em;
                                        margin-left: 2px;
                                   }

                                   .ii {
                                        color: #00a8ff;
                                        height: 15px;
                                        font-size: 2em;
                                        margin-left: 5px;
                                   }

                                   .i2 {
                                        color: #00a8ff;
                                        height: 10px;
                                        font-size: 2em;
                                        margin-left: 2px;
                                   }

                                   .c {
                                        height: 200px;
                                        font-size: 0.5em;


                                   }

                                   .p {
                                        color: red;
                                        height: 10px;
                                        font-size: 12px;
                                   }

                                   .et {
                                        width: 100%;
                                        height: 10px;
                                        justify-content: center;
                                        margin: 10px auto;
                                   }

                              }

                              @media (max-width: 575px) {
                                   .main {

                                        height: 500px;
                                        overflow: hidden;
                                   }

                                   .bor {
                                        list-style-type: none;
                                        height: 70px;
                                        width: 1200px;
                                        border-radius: 20px;
                                        border: 1px solid #ddd;
                                   }

                                   .i {
                                        color: #00a8ff;
                                        font-size: 2em;
                                        margin-left: 50px;
                                   }

                                   .ii {
                                        color: #00a8ff;
                                        font-size: 2em;
                                        margin-left: 70px;
                                   }

                                   .i2 {
                                        color: #00a8ff;
                                        font-size: 2em;
                                        margin-left: 60px;
                                   }

                                   .c {
                                        height: 200px;
                                        font-size: 1em;
                                        margin-left: 100px;

                                   }

                                   .p {
                                        color: red;
                                        margin-left: 10px;
                                        font-size: 1em;
                                   }

                                   .et {
                                        width: 100%;
                                        height: 10px;
                                        justify-content: center;
                                        margin: 10px auto;
                                   }

                              }


                              @media (max-width: 412px) {
                                   .main {

                                        height: 500px;
                                        overflow: hidden;
                                   }

                                   .bor {
                                        list-style-type: none;
                                        height: 70px;
                                        width: 1200px;
                                        border-radius: 20px;
                                        border: 1px solid #ddd;
                                   }

                                   .i {
                                        color: #00a8ff;
                                        font-size: 1em;
                                        margin-left: 50px;
                                   }

                                   .ii {
                                        color: #00a8ff;
                                        font-size: 1em;
                                        margin-left: 70px;
                                   }

                                   .i2 {
                                        color: #00a8ff;
                                        font-size: 1em;
                                        margin-left: 60px;
                                   }

                                   .c {
                                        height: 200px;
                                        font-size: 1em;
                                        margin-left: 100px;

                                   }

                                   .p {
                                        color: red;
                                        margin-left: 10px;
                                        font-size: 1em;
                                   }

                                   .et {
                                        width: 100%;
                                        height: 10px;
                                        justify-content: center;
                                        margin: 10px auto;
                                   }

                              }

                              @media (max-width: 575px) {
                                   .main {

                                        height: 500px;
                                        overflow: hidden;
                                   }

                                   .bor {
                                        list-style-type: none;
                                        height: 70px;
                                        width: 1200px;
                                        border-radius: 20px;
                                        border: 1px solid #ddd;
                                   }

                                   .i {
                                        color: #00a8ff;
                                        font-size: 1em;
                                        margin-left: 50px;
                                   }

                                   .ii {
                                        color: #00a8ff;
                                        font-size: 1em;
                                        margin-left: 70px;
                                   }

                                   .i2 {
                                        color: #00a8ff;
                                        font-size: 1em;
                                        margin-left: 60px;
                                   }

                                   .c {
                                        height: 200px;
                                        font-size: 0.5em;
                                        margin-left: 100px;

                                   }

                                   .p {
                                        color: red;
                                        margin-left: 10px;
                                        font-size: 1em;
                                   }

                                   .et {
                                        width: 100%;
                                        height: 10px;
                                        justify-content: center;
                                        margin: 10px auto;
                                   }

                                   .labe {
                                        color: red;
                                        margin-left: 10px;
                                        font-size: 1em;
                                   }
                              }
                         </style>
                         <input type="checkbox" id="chk" aria-hidden="true">

                         <div class="signup">
                              <div class="row">
                                   <div>
                                        <h4>
                                             <p class="text  mt-3 mb-0 text-center fw-500">
                                                  <?= $produit['marque'] ?>,
                                                  <?= $produit['nom'] ?></p>
                                        </h4>
                                   </div>
                                   <div class=" col-sm-1 ">

                                   </div>
                                   <div class=" col-sm-3 row ">
                                        <div class=" col-sm-6 bor">
                                             <li class="p"> carburation <i class="fa fa-cogs i" aria-hidden="true"></i> <i class="c  a1"><?= $produit['carburant'] ?></i></li>
                                        </div>
                                   </div>
                                   <div class=" col-sm-3 row ">
                                        <div class="col-sm-6 bor">
                                             <li class="p">Kilométrage <i class="fas fa-tachometer-alt-fastest i"></i> <i class="c  a1"><?= $produit['kilometrage'] ?></i></li>
                                        </div>
                                   </div>
                                   <div class=" col-sm-3 row ">
                                        <div class="col-sm-6 bor">
                                             <li class="p">Prix/jour <i class="far fa-sack-dollar i"></i><i class="c"><?php if ($produit['prixparjour'] > 0) : ?><?= $produit['prixparjour'] ?> FCFA<?php endif; ?></i></li>
                                        </div>
                                   </div>

                                   <div class=" col-sm-2 row ">
                                        <div class="col-sm-10 bor">
                                             <li class="p">Date-sortie <i class="fa fa-calendar i2 " aria-hidden="true"></i><i class="c  a1"><?= $produit['annee_modele'] ?></i></li>
                                        </div>
                                   </div>
                                   <div class="et">
                                        <p class="mt-3 mb-0 text-center fw-500" style="list-style-type:none; border-radius: 15px; border: 1px solid #ddd;">
                                             <?= $produit['etat_vehicule'] ?>
                                        </p>
                                   </div>
                              </div>
                         </div>

                         <div class="login">

                              <label for="chk" aria-hidden="true" class="btn-primary labe" style="list-style-type:none; border-radius: 15px; border: 1px solid #ddd;"> Voir les
                                   accessoirs</label>
                              <div class="row">
                                   <div class=" mis col-sm-6">
                                        <table>

                                             <tr>
                                                  <td>Air Conditionner</td>
                                                  <?php if ($produit['air_conditionner'] == 1) { ?>

                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>


                                             <tr>
                                                  <td>Lecteur cd</td>
                                                  <?php if ($produit['lecteur_cd'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>Porte electrique</td>
                                                  <?php if ($produit['porte_electrique'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>Airbag passager</td>
                                                  <?php if ($produit['airbag_passager'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn  btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>Capteur de collision</td>
                                                  <?php if ($produit['capteur_collision'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>Fermeture centrale</td>
                                                  <?php if ($produit['fermeture_central'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                        </table>
                                   </div>
                                   <div class="met col-sm-6">
                                        <table>

                                             <tr>
                                                  <td>Airbag chauffeur</td>
                                                  <?php if ($produit['airbag_chauffeur'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>Vitre electrique</td>
                                                  <?php if ($produit['vitres_electrique'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>Direction assistée</td>
                                                  <?php if ($produit['direction_assistee'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>Assistance de freinage</td>
                                                  <?php if ($produit['assistant_freinage'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                             <tr>
                                                  <td>systeme de freinage</td>
                                                  <?php if ($produit['systeme_freinage'] == 1) {
                                                  ?>
                                                       <td><i class="fa fa-check btn btn-primary" aria-hidden="true"></i>
                                                       </td>
                                                  <?php } else { ?>
                                                       <td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
                                                  <?php } ?>
                                             </tr>

                                        </table>
                                   </div>
                              </div>
                         </div>

                    </div>
               </div>

               <div class="col-sm-3 row">
                    <div class="sidebar_widget">
                         <div class="widget_heading">
                              <h5><i class="fa fa-plus" aria-hidden="true"></i> Ajouter aux panier le:</h5>
                         </div>
                         <form action="panier.php" method="post">
                              <div class="group">
                                   Vehicule: <?= $produit['nom'] ?> <br><?= $produit['kilometrage'] ?>/H

                                   <?= $produit['prixparjour'] ?> par jour
                              </div><br>
                              <div class="form-group">
                                   chosir le nombre :
                                   <input type="number" class="form-control" name="quantité" value="1" min="1" max="<?= $produit['quantite'] ?>" placeholder="Quantité" required>
                                   <input type="hidden" name="produit_id" value="<?= $produit['id_vehi'] ?>">
                              </div>
                              <div>
                                   <button name="submit" class="thm-btn btn-rectangle thm-bg-color-one w-100">Ajouter maintenant</button>
                              </div>
                         </form>

                    </div>


               </div>
          </div>

     </section>
     <div style="border:solid 1px #ddd"></div>
     <section class="section-padding pt-0">
          <div class="container-fluid">
               <div class="section-header">
                    <h3 class="title">les vehicules aux prix similaire</h3>
                    <p class="text"></p>
               </div>
               <div class="vegetables-slider row">
                    <?php
                    $bid = $_SESSION['nom'];
                    $sql = "SELECT * from  vehicule  where prixparjour=:bid AND statut='louer'  ";
                    $query = $bdd->prepare($sql);
                    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
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
                                        <h4 class="title"><a href="details.php?id_vehi=<?php echo htmlentities($result->id_vehi); ?>"><?php echo htmlentities($result->nom); ?></a>
                                        </h4>
                                        <div class="price">
                                             <span><?php echo htmlentities($result->prixparjour); ?></span><small>fcfa/jour</small>
                                        </div>
                                        <div class="product_qty">
                                             <span><?php echo htmlentities($result->kilometrage); ?></span>/H
                                        </div>
                                        <div class="product_action">
                                             <button type="button" class="product_btn" style=" background-color: #007FFF;"><a href="details.php?id_vehi=<?php echo $result->id_vehi; ?>" style="color: #FFF;"><i class="fa fa-plus"></i>
                                                       Ajouter</a> </button>
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