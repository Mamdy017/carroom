<?php
session_start();
error_reporting(0);

include 'includes/config.php';
$bdd = pdo_connect_mysql();
$error = "";
$msg = "";
if (isset($_POST['inscription'])) {
     $nom = htmlspecialchars($_POST['nom']);
     $prenom = htmlspecialchars($_POST['prenom']);
     $email = htmlspecialchars($_POST['email']);
     $tel = htmlspecialchars($_POST['tel']);
     $sexe = htmlspecialchars($_POST['sexe']);
     $password = htmlspecialchars($_POST['password']);
     $password1 = htmlspecialchars($_POST['password1']);
     $photo = $_FILES["photo"]["name"];
     $upload = "image/" . $photo; 

     move_uploaded_file($_FILES['photo']['tmp_name'], $upload);

     if (empty($nom)) {
          $error = "champ non est vide";
     } else if (empty($prenom)) {
          $error = "champ prenom est vide";
     } else if (empty($tel)) {
          $error = "champ telephone est vide";
     } else if (empty($sexe)) {
          $error = "Champ sexe est vide";
     } else if (empty($email)) {
          $error = "Champ email est vide";
     } else if (empty($password)) {
          $error = "Champ mot de passe est vide";
     } else if (empty($password1)) {
          $error = "champ confirmation de mot de passe est vide";
     } else {
          $recherche = $bdd->prepare('SELECT emailid, password from client where emailid=?');
          $recherche->execute(array($email));
          $data = $recherche->fetch();
          $row = $recherche->rowCount();

          if ($row == 0) {
               if (strlen($nom) <= 100) {
                    if (strlen($email) <= 100) {
                         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                              if (strlen($password) >= 8) {
                                   if ($password == $password1) {
                                        $password = hash('sha256', $password);

                                        $insert = $bdd->prepare('INSERT INTO client 
                          (nom, prenom, emailid, telephone, sexe, photo, password)
                         VALUES(?,?,?,?,?,?,?)');
                                        $insert->execute(array(
                                             $nom, $prenom, $email, $tel, $sexe, $photo, $password
                                        ));
                                        header('location: connexion.php?reg_err=success');
                                   } else header('location: register.php?reg_err=password');
                              } else header('location: register.php?reg_err=long');
                         } else header('location: register.php?reg_err=email');
                    } else header('location: register.php?reg_err=email_length');
               } else header('location: register.php?reg_err=nom_length');
          } else header('location: register.php?reg_err=already');
     }
}

?>

<!DOCTYPE HTML>
<html lang="en">


<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Carrom || Inscription</title>
     <?php include 'includes/css2.php';
     include 'includes/css.php';
     ?>
     <link rel="canonical" href="https://www.creative-tim.com/product/soft-ui-dashboard" />

     <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Soft UI Dashboard bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, free dashboard, free admin dashboard, free bootstrap 5 admin dashboard">
     <meta name="description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">

     <meta name="twitter:card" content="product">
     <meta name="twitter:site" content="@creativetim">
     <meta name="twitter:title" content="Soft UI Dashboard by Creative Tim">
     <meta name="twitter:description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
     <meta name="twitter:creator" content="@creativetim">
     <meta name="twitter:image" content="/../s3.amazonaws.com/creativetim_bucket/products/450/original/opt_sd_free_thumbnail.png">
     <link href="assets2/css/nucleo-icons.css" rel="stylesheet" />
     <link href="assets2/css/nucleo-svg.css" rel="stylesheet" />

     <script src="/../kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
     <link href="assets2/css/nucleo-svg.css" rel="stylesheet" />

     <link id="pagestyle" href="assets2/css/soft-ui-dashboard.minc924.css?v=1.0.6" rel="stylesheet" />


</head>

<body>

     <?php include 'includes/head.php'; ?>
     <?php include 'includes/menu_barre.php'; ?>
     <main class="main-content  mt-0">
          <section class="min-vh-100 mb-8">
               <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('assets/images/index/R.jpg');">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                    <div class="container">
                         <div class="row justify-content-center">
                              <div class="col-lg-5 text-center mx-auto">
                                   <h1 class="text-white mb-2 mt-5">Bienvenue!</h1>
                                   <p class="text-lead text-white">Creer un compte gratuitement</p>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="container">
                    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                         <div class="col-xl-5 col-lg-6 col-md-9 mx-auto">
                              <div class="card z-index-0">
                                   <div class="card-header text-center pt-4">
                                        <h5>Formulaire d'Inscription</h5>
                                        <?php if (isset($_GET['reg_err'])) {
                                             $err = htmlspecialchars($_GET['reg_err']);
                                             switch ($err) {
                                                  case 'success':
                                        ?><div class="succWrap"><strong>Succès: </strong>Felicitations ton compte a été crée</div><?php break;
                                                                                                                             case 'password':
                                                                                                                                  ?> <div class="errorWrap"><strong>Erreur: </strong>mot de passe ne sont pas les mêmes</div><?php break;
                                                                                                                                                                                                                                                     case 'long':
                                                                                                                                                                                                                                                          ?> <div class="errorWrap"><strong>Erreur: </strong>mot de passe minimum 8 caratères</div><?php break;
                                                                                                                                                                                                                                                     case 'email':
                                                                                                                                                                                                                                                          ?><div class="errorWrap"><strong>Erreur: </strong>Email non valide</div><?php break;
                                                                                                                                                                                                                                                     case 'email_length':
                                                                                                                                                                                                                                      ?> <div class="errorWrap"><strong>Erreur: </strong>Email trop long</div><?php break;
                                                                                                                                                                                                                                                     case 'nom_length':
                                                                                                                                                                                                                       ?><div class="errorWrap"><strong>Erreur: </strong>Nom trop long</div><?php break;
                                                                                                                                                                                                                                                     case 'already':
                                                                                                                                                                                                                  ?> <div class="errorWrap"><strong>Erreur: </strong> Ce compte existe déjà</div><?php break;
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                           }
                                                                                                                                                                                                                       ?>
                                        <?php if ($error) { ?><div class="errorWrap">
                                                  <strong>ERREUR</strong>:<?php echo htmlentities($error); ?>
                                             </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                   </div>
                                   <div class="row px-xl-5 px-sm-4 px-3">
                                        <div class="card-body">
                                             <form action=" " method="post" enctype="multipart/form-data">
                                                  <div class="mb-3">
                                                       <input type="text" class="form-control" name="nom" placeholder="Nom" aria-label="Name" aria-describedby="email-addon">
                                                  </div>
                                                  <div class="mb-3">
                                                       <input type="text" class="form-control" name="prenom" placeholder="Prenom" aria-label="Name" aria-describedby="email-addon">
                                                  </div>
                                                  <div class="mb-3">
                                                       <input type="text" class="form-control" name="tel" placeholder="Telephone" aria-label="Name" aria-describedby="email-addon">
                                                  </div>
                                                  <div class="mb-3">
                                                  <select class="form-select"  name="sexe" id="inputCollection">
                                                                           <option>genre</option>
                                                                           <option value="Masculin">Masculin</option>
                                                                           <option value="Feminin">Feminin</option>
                                                                      </select>
                                                       <!-- <input type="text" class="form-control" name="sexe" placeholder="Sexe" aria-label="Name" aria-describedby="email-addon"> -->
                                                  </div>
                                                  <div class="mb-3">
                                                       <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                                  </div>
                                                  <div class="mb-3">
                                                       <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                                  </div>
                                                  <div class="mb-3">
                                                       <input type="password" class="form-control" id name="password1" placeholder="ConfirmPassword" aria-label="Password" aria-describedby="password-addon">
                                                  </div>
                                                  <div class="mb-3">
                                                       <input type="file" class="form-control" name="photo" placeholder="photo" aria-label="Password" aria-describedby="password-addon">
                                                  </div>
                                                  <style>
                                                       .cor {
                                                            background: #56A9FF;
                                                       }

                                                       .txt {
                                                            color: #56A9FF;
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
                                                  <div class="text-center">
                                                       <button type="submit" class="btn bg-gradient cor w-100 my-4 mb-2" name="inscription">S'inscrire</button>
                                                  </div>
                                                  <p class="text-sm mt-3 mb-0">J'ai un compte? <a href="connexion.php" class="text txt font-weight-bolder">Connexion</a></p>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
     </main>

     <?php include 'includes/footer.php';
     ?><script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
     </script>
     <script src="assets/js/plugins/jquery-3.6.0.min.js"></script>
     <script src="assets/js/plugins/bootstrap.bundle.min.js"></script>
     <script src="assets/js/plugins/slick.min.js"></script>
     <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
     <script src="assets/js/plugins/jquery.counterup.min.js"></script>
     <script src="assets/js/plugins/jquery.inview.min.js"></script>
     <script src="assets/js/custom.js"></script>
     <script src="../assets/js/core/popper.min.js"></script>
</body>

</html>