<?php
session_start();
include('includes/config.php');
error_reporting(0);
$bdd = pdo_connect_mysql();
/* Si l'utilisateur a cliqué sur le bouton "Ajouter au panier" sur la page du produit, nous pouvons vérifier les données du formulaire.*/
if (isset($_POST['produit_id'], $_POST['quantité']) && is_numeric($_POST['produit_id']) && is_numeric($_POST['quantité'])) {
     /* Définissez les variables post afin que nous puissions les identifier facilement, assurez-vous également qu'elles sont entières.*/
     $produit_id = (int)$_POST['produit_id'];
     $quantité = (int)$_POST['quantité'];
     /* Préparez l'instruction SQL, nous vérifions essentiellement si le produit existe dans notre base de données.*/
     $stmt = $bdd->prepare('SELECT * FROM vehicule WHERE id_vehi = ?');
     $stmt->execute([$_POST['produit_id']]);
     /* Récupère le produit depuis la base de données et renvoie le résultat sous forme de tableau.*/
     $produit = $stmt->fetch(PDO::FETCH_ASSOC);
     // Vérifier si le produit existe (le tableau n'est pas vide)   
     if ($produit && $quantité > 0) {
          /*Le produit existe dans la base de données, maintenant nous pouvons créer/mettre à jour la variable de session pour le panier.*/
          if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
               if (array_key_exists($produit_id, $_SESSION['panier'])) {
                    // Le produit existe dans le panier, il suffit de mettre à jour la quantité.   
                    $_SESSION['panier'][$produit_id] += $quantité;
               } else {
                    // Le produit n'est pas dans le panier, ajoutez-le   
                    $_SESSION['panier'][$produit_id] = $quantité;
               }
          } else {
               /* Il n'y a aucun produit dans le panier, ceci ajoutera le premier produit au panier.*/
               $_SESSION['panier'] = array($produit_id => $quantité);
          }
     }
     // Empêcher la resoumission des formulaires...   
     header('location: panier.php');
     exit;
}



/* Retirez le produit du panier, vérifiez le paramètre "remove" de l'URL, c'est l'identifiant du produit, assurez-vous qu'il s'agit d'un numéro et vérifiez s'il est dans le panier.*/
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['panier']) && isset($_SESSION['panier'][$_GET['remove']])) {
     // Remove the produit from the shopping panier   
     unset($_SESSION['panier'][$_GET['remove']]);
     echo "<scrip>alert('Voiture retirée avec succès');</script>";
}
/* Mettre à jour les quantités de produits dans le panier si l'utilisateur clique sur le bouton "Mettre à jour" sur la page du panier d'achat*/
if (isset($_POST['update']) && isset($_SESSION['panier'])) {
     /* Boucle à travers les données postales afin de mettre à jour les quantités pour chaque produit du panier.*/
     foreach ($_POST as $k => $v) {
          if (strpos($k, 'quantité') !== false && is_numeric($v)) {
               $id = str_replace('quantité-', '', $k);
               $quantité = (int)$v;
               // Effectuez toujours des contrôles et des validations   
               if (is_numeric($id) && isset($_SESSION['panier'][$id]) && $quantité > 0) {
                    // Mise à jour de la nouvelle quantité   
                    $_SESSION['panier'][$id] = $quantité;
               }
          }
     }
}

/* Vérification de la variable de session pour les produits en panier*/
$produits_in_panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();
$produits = array();
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$message = $_POST['message'];
$chauffeur = $_POST['chauf'];
$j = ceil(abs(strtotime($fin) - strtotime($debut)) / 86400);
$subtotal = 0.00;
// S'il y a des produits dans le panier   
if ($produits_in_panier) {
     /* Il y a des produits dans le panier, nous devons donc sélectionner ces produits dans la base de données.*/
     /* Mettre les produits du panier dans un tableau de chaîne de caractères avec point d'interrogation, nous avons besoin que l'instruction SQL inclue  ( ?,?, ?,...etc).*/
     $array_to_question_marks = implode(',', array_fill(0, count($produits_in_panier), '?'));
     $stmt = $bdd->prepare('SELECT * FROM vehicule WHERE id_vehi IN (' . $array_to_question_marks . ')');
     /* Nous avons uniquement besoin des clés du tableau, pas des valeurs, les clés sont les identifiants des produits. */
     $stmt->execute(array_keys($produits_in_panier));
     /* Récupérer les produits de la base de données et retourner le résultat sous la forme d'un tableau.*/
     $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
     // Calculez le total partiel   
     foreach ($produits as $produit) {
          $subtota += (float)$produit['prixparjour'] * (int)$produits_in_panier[$produit['id_vehi']] + $chauffeur;
          $subtotal = $j * $subtota;
     }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Carrom || panier</title>
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
     <?php $num = mt_rand(100000000, 999999999); ?>
     <form action="" method="post" class="row" enctype="multipart/form-data">
          <!-- === Les caractérisquent existant du vehicule   === -->
          <section class="section-padding pb-0 col-sm-8">
               <div class="container-fluid">
                    <div class="table-responsive cart_table">
                         <table>
                              <thead>
                                   <tr>
                                        <th class="remove-item"></th>
                                        <th>Voiture</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if (empty($produits)) : ?>
                                        <tr>
                                             <td colspan="5" style="text-align:center;">Vous n'avez aucun produit ajouté dans votre panier</td>
                                        </tr>
                                   <?php else : ?>
                                        <?php foreach ($produits as $produit) : ?>
                                             <tr>
                                                  <td class="remove">
                                                       <a href="panier.php?remove=<?= $produit['id_vehi'] ?>" class="remove">
                                                            <button class="remove-from-cart" type="button"><span></span><span></span></button>
                                                       </a>
                                                  </td>
                                                  <td>
                                                       <div class="cart_product">
                                                            <img src="admin/img/voitureimages/<?= $produit['img1'] ?>" class="image-fit-contain" alt="img">
                                                            <input type="text" class="form-controle" name="id_vehi[]" value="<?= $produit['id_vehi'] ?>">
                                                            <div class="cart_product_text">
                                                                 <h6 class="title">
                                                                      <a href="ajouter.php"><?= $produit['nom'] ?></a>
                                                                      <input type="hidden" name="nom[]" value="<?= $produit['nom'] ?>">
                                                                      <input type="hidden" name="num[]" value="<?php echo $num ?>">
                                                                      <input type="hidden" name="email[]" value="<?php echo $_SESSION['login']; ?>">
                                                                      <input type="hidden" name="message1[]" value="<?= $message ?>">
                                                                      <input type="hidden" name="debut1[]" value="<?= $debut ?>">
                                                                      <input type="hidden" name="fin1[]" value="<?= $fin ?>">
                                                                      <input type="hidden" name="chauffeur1[]" value="<?= $chauffeur ?>">
                                                                      <input type="hidden" name="type[]" value="1">
                                                                      <input type="hidden" name="mois[]" value="<?php echo date("m"); ?>">
                                                                      <input type="hidden" name="date[]" value="<?php echo date("y-m-d"); ?>">
                                                                      <input type="hidden" name="status[]" value="0">
                                                                 </h6>
                                                            </div>
                                                       </div>
                                                  </td>
                                                  <td>
                                                       <strong><input type="hidden" name="prix" value="<?= $produit['prixparjour'] ?>" id="poids"> <?= $produit['prixparjour'] ?> Fcfa</strong>
                                                  </td>
                                                  <td class="product_block product_details">
                                                       <div class="product_action">
                                                            <div class="quantity m-0">
                                                                 <button class="btn qty-mins" type="button"><i class="fal fa-minus"></i></button>
                                                                 <input type="number" name="quantité-<?= $produit['id_vehi'] ?>" value="<?= $produits_in_panier[$produit['id_vehi']] ?>" autocomplete="off" readonly>
                                                                 <input type="hidden" name="quantite[]" value="<?php echo (int)$produits_in_panier[$produit['id_vehi']]  ?>">
                                                                 <button class="btn qty-add" type="button"><i class="fal fa-plus"></i></button>
                                                            </div>
                                                       </div>
                                                  </td>
                                                  <td>
                                                       <input type="hidden" name="total1[]" value="<?= ($produit['prixparjour'] * $produits_in_panier[$produit['id_vehi']] + $chauffeur) * $j ?>">
                                                       <strong><?= ($produit['prixparjour'] * $produits_in_panier[$produit['id_vehi']] + $chauffeur) * $j ?> Fcfa</strong>
                                                  </td>
                                             </tr>
                                   <?php endforeach;
                                   endif; ?>
                              </tbody>
                         </table>
                    </div>
               </div>
               <button type="submit" class="maj" name="update"> Mettre a jour</button>
               <div class="container-fluid">
                    <div class="row justify-content-center">
                         <div class="col-lg-8">
                              <h5 class="title at">Totaux</h5>
                              <table>
                                   <tbody>
                                        <tr>
                                             <th>Totaux</th>
                                             <td><?php echo $subtotal; ?> Fcfa</td>
                                             <input type="hidden" name="total" required value="<?= $subtotal ?>" id="">
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
               <a href="louer.php" class="ma">Ajouter une nouvelle voiture?</a>

          </section>
          <!-- === Fin caracteristique du vehicule === -->
          <!-- === Envoyez la Réservation à l'administrateur === -->
          <?php
          if (isset($_POST['ajouter'])) {
               // Déclaration des variables
               $id = count($_POST['id_vehi']);
               $vhid = $_POST['id_vehi'];
               $user = $_POST['email'];
               $nom = $_POST['nom'];
               $book = $_POST['num'];
               $status = $_POST['status'];
               $message1 = $_POST['message1'];
               $debut1 = $_POST['debut1'];
               $chauffeur = $_POST['chauffeur1'];
               $fin = $_POST['fin1'];
               $total = $_POST['total1'];
               $date_ajout = $_POST['date'];
               $mois = $_POST['mois'];
               $quantite = $_POST['quantite'];
               $type = $_POST['type'];
               $date2 = $_POST['debut'];
               $fin2 = $_POST['fin'];
               $auj = date('y-m-d', strtotime('+3 day'));
               $debut = $date2;
               // Début des conditions de réservation
               if (empty($debut)) {
                    $error = "champ date debut est vide";
               } else if (empty($fin2)) {
                    $error = "champ date de fin est vide";
               } else if (empty($message)) {
                    $error = "champ message est vide";
               } else {
                    if (strtotime($auj) <= strtotime($date2)) {
                         if (strtotime($date2) < strtotime($fin2)) {
                              if ($total > 1000) {
                                   for ($i = 0; $i <= count($vhid); $i++) {
                                        $insert = $bdd->prepare('INSERT INTO reservation(email,quantite,id_vehi,nom,num ,statut,debut,fin,message,chauffeur,total,date_ajout,mois,type) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        $insert->execute(array($user[$i], $quantite[$i], $vhid[$i], $nom[$i], $book[$i], $status[$i], $debut1[$i], $fin[$i], $message1[$i], $chauffeur[$i], $total[$i], $date_ajout[$i], $mois[$i], $type[$i]));
                                        if ($insert) {
                                             unset($_SESSION['panier']);
                                             echo "<script>alert('Reservation effectuée avec succès');</script>";
                                             echo "<script type='text/javascript'> document.location = 'espace_client/mes_reservation.php'; </script>";
                                        } else {
                                             $error = "Une erreur s'est produite";
                                        }
                                   }
                              } else {
                                   $error = "Veuillez mettre à jour";
                              }
                         } else {
                              $error = "La date de debut doit être superieur  à la date de fin";
                         }
                    } else {
                         echo "<script>alert('La réservation doit se faire 2 jours avant');</script>";
                    }
               }
          }
          ?>
          <!-- === Fin partie php de la Réservation  === -->
          <!-- === La section date-debut, date-fin et message === -->
          <section class="section pt-0 col-sm-4">
               <div class="container-fluid">
                    <div class="row justify-content">
                         <div class="col-lg-11">
                              <div class="sidebar_widget">
                                   <div class="widget_heading">
                                        <h5><i class="fa fa-plus" aria-hidden="true"></i>Panier de reservation:</h5>
                                   </div>
                                   <?php if ($error) { ?><div class="errorWrap">
                                             <strong>ERREUR</strong>:<?php echo htmlentities($error); ?>
                                        </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

                                   <div class="form-group">
                                        <label>Date-debut:</label>
                                        <input type="date" class="form-control" name="debut" placeholder="From Date" id="d1" value="<?= $debut ?>">
                                   </div>
                                   <div class="form-group">
                                        <label>Date-fin:</label>
                                        <input type="date" class="form-control" name="fin" placeholder="To Date" id="d2" value="<?= $fin ?>">
                                   </div>
                                   <div class="form-group">
                                        <input type="hidden" value="$j">
                                        <label>Avec chauffeur? 20 000 Fcfa/jour</label>
                                        <input type="checkbox" class="A radio" name="chauf" value="20000" <?php if (in_array(20000, $chauffeur)) echo "checked" ?>>
                                   </div>
                                   <div class="form-group">
                                        <input type="text" rows="4" class="form-control" name="message" placeholder="Message" value="<?= $message ?>">
                                        <input type="hidden" name="remove">
                                   </div>
                                   <?php
                                   if (strlen($_SESSION['login']) == 0) { ?>
                                        <a href="connexion.php" class="thm-btn btn-rectangle thm-bg-color-one w-100">Reservez</a>
                                   <?php } else { ?>
                                        <button class="thm-btn btn-rectangle thm-bg-color-one w-100" name="ajouter">Reservez maintenant</button>
                                   <?php  } ?>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
          <!-- === fin de la section date-debut, date-fin et message === -->
     </form>
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
<style>
     .A {
          position: relative;
          left: 60px;
          width: 20px;
          box-shadow: 100%;
     }

     .sidebar_widget {
          top: 80px;
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

     .form-controle {
          color: #fff;
          width: 0px;
          border: none;
     }

     .maj {
          background-color: #509EEF;
          color: white;
          width: 100px;
          height: 40px;
          margin-left: 700px;
          border-radius: 8px;
     }

     .ma {
          background-color: #509EEF;
          color: white;
          width: 250px;
          height: 30px;
          margin-left: 100px;
          border-radius: 8px;
     }

     .errorWrap {
          padding: 10px;
          margin: 0 0 20px 0;
          background: #fff;
          color: red;
          border-left: 4px solid #dd3d36;
          -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
          box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
     }

     .succWrap {
          padding: 10px;
          margin: 0 0 20px 0;
          background: #fff;
          border-left: 4px solid #5cb85c;
          -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
          box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
     }
</style>

</html>