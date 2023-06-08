<?php
session_start();
error_reporting(0);
require_once 'includes/config.php';
$bdd = pdo_connect_mysql();
if (isset($_POST['emailid']) && isset($_POST['password'])) {
     $emailid = htmlspecialchars($_POST['emailid']);
     $password = htmlspecialchars($_POST['password']);
     if (empty($emailid)) {
          $error = "Champ email est vide";
     } else if (empty($password)) {
          $error = "Champ mot de passe est vide";
     } else {
          $recherche = $bdd->prepare('SELECT nom, emailid, password from client where emailid=?');
          $recherche->execute(array($emailid));
          $data = $recherche->fetch();
          $row = $recherche->rowCount();

          if ($row == 1) {
               if (filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
                    $password = hash('sha256', $password);
                    if ($data['password'] === $password) {
                         session_id('session1');
                         $_SESSION['login'] = $_POST['emailid'];
                         $_SESSION['fname'] = $results->nom;
                         session_write_close();
                         header('location:' . $_POST['page']);
                    } else $error = "Mot de passe incorrect";
               } else $error = "Email incorrect";
          } else $error = "Compte inexistant";
     }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Carrom || Connexion</title>
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
     <script src="/../kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
     <link href="assets2/css/nucleo-svg.css" rel="stylesheet" />
     <link id="pagestyle" href="assets2/css/soft-ui-dashboard.minc924.css?v=1.0.6" rel="stylesheet" />


</head>

<body>
     <div class="preloader">
          <img src="assets/images/preloader.svg" alt="preloader">
     </div>
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
                                   <p class="text-lead text-white">Veuillez vous connecter</p>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="container">
                    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                         <div class="col-xl-5 col-lg-6 col-md-9 mx-auto">
                              <div class="card z-index-0">
                                   <div class="card-header text-center pt-4">
                                        <h5>Formulaire de connexion</h5>
                                        <?php if ($error) { ?><div class="errorWrap">
                                                  <strong>ERREUR</strong>:<?php echo htmlentities($error); ?>
                                             </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                   </div>
                                   <div class="row px-xl-5 px-sm-4 px-3">
                                        <div class="card-body">
                                             <form role="form text-left" Method="POST" enctype="multipart/form-data ">
                                                  <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                                                  <div class="mb-3">
                                                       <input type="email" class="form-control" name="emailid" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                                  </div>
                                                  <div class="mb-3">
                                                       <input type="password" class="form-control" name="password" placeholder="Mot de passe" aria-label="Password" aria-describedby="password-addon">
                                                  </div>
                                                  <p class="text-sm mt-3 mb-0">Mot de passe oublié? <a href="mdp_oublie.php" class="text txt font-weight-bolder">Modifier</a></p>
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
                                                       <button type="submit" class="btn bg-gradient cor w-100 my-4 mb-2">CONNEXION</button>
                                                  </div>
                                                  <p class="text-sm mt-3 mb-0">J'ai pas de compte? <a href="register.php" class="text txt font-weight-bolder">Inscription</a></p>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
     </main>
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

</html>