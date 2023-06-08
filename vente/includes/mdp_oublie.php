<?php
$error = "";
$msg = "";
require_once 'config.php';
$bdd = pdo_connect_mysql();
?>

<!DOCTYPE html>
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
     <link rel="icon" type="../image/png" sizes="32x32" href="favicon.ico">
     <link href=" ../assets/css/plugins/bootstrap.min.css" rel="stylesheet">
     <link href="../assets/fonts/font-awesome.min.css" rel="stylesheet">
     <link href="../assets/css/plugins/magnific-popup.css" rel="stylesheet">
     <link href="../assets/css/plugins/slick.css" rel="stylesheet">
     <link href="../assets/css/stylee.css" rel="stylesheet">
     <link href="../assets/css/responsive.css" rel="stylesheet">
     <link rel="shortcut icon" href="../assets/images/icon/favicon.png">
</head>

<body>
     <div class="preloader">
          <img src="../assets/images/preloader.svg" alt="preloader">
     </div>
     <?php include 'head.php'; ?>
     <?php include 'menu_barre.php'; ?>
     <section class="section">
          <div class="container-fluid">
               <div class="row justify-content-center">
                    <div class="col-lg-6">
                         <div class="">
                              <div class="box_inner">
                                   <form action="#" method="POST">
                                        <div class="main">
                                             <div class="login">
                                                  <form method="post">
                                                       <?php if ($error) { ?><div class="errorWrap">
                                                                 <strong>Erreur</strong>:<?php echo htmlentities($error); ?>
                                                            </div><?php } else if ($msg) { ?><div class="succWrap"><strong>Succè<small></small></strong>:<?php echo htmlentities($msg); ?> </div>
                                                       <?php } ?>
                                                       <h3>Modifier le mot de passe</h3>
                                                       <input type="email" name="emailid" placeholder="Email" required>
                                                       <button>Connexion</button>
                                                  </form>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <style>
          .main {
               width: 600px;
               height: 320px;
               overflow: hidden;
               border-radius: 10px;
               box-shadow: 5px 20px 50px #000;
          }

          button {
               width: 80%;
               height: 40px;
               margin: 10px auto;
               justify-content: center;
               display: block;
               color: #fff;
               background: #00a8ff;
               font-size: 1em;
               font-weight: bold;
               margin-top: 20px;
               outline: none;
               border: none;
               border-radius: 5px;
               transition: .2s ease-in;
               cursor: pointer;
          }

          h3 {
               color: #2c75ff;
               font-size: 2.5em;
               justify-content: center;
               display: flex;
               margin: 60px;
               font-weight: bold;
               cursor: pointer;

          }

          input {
               width: 80%;
               height: 40px;
               background: #ededed;
               justify-content: center;
               display: flex;
               margin: 20px auto;
               padding: 10px;
               border: none;
               outline: none;
               border-radius: 5px;
          }

          button:hover {
               background: #6d44b8;
          }




          @media screen and (max-width: 768px) {
               .main {
                    width: 100%;
                    width: 450px;
                    height: 240px;
                    overflow: hidden;
                    border-radius: 10px;
                    grid-template-columns: 1fr;
               }

               h3 {

                    font-size: 1.5em;
                    display: inline;
               }
          }

          @media screen and (max-width: 320px) {
               .main {
                    width: 100%;
                    width: 300px;
                    height: 180px;
                    overflow: hidden;
                    border-radius: 10px;
                    grid-template-columns: 1fr;
               }

               h3 {

                    font-size: 1em;
                    display: inline;
               }
          }

          @media screen and (max-width: 412px) {
               .main {
                    width: 100%;
                    width: 350px;
                    height: 180px;
                    overflow: hidden;
                    border-radius: 10px;
                    grid-template-columns: 1fr;
               }

               h3 {

                    font-size: 1.2em;
                    display: inline;
               }
          }

          @media screen and (max-width: 428px) {
               .main {
                    width: 100%;
                    width: 380px;
                    height: 280px;
                    overflow: hidden;
                    border-radius: 10px;
                    grid-template-columns: 1fr;
               }

               h3 {

                    font-size: 1.2em;
                    display: inline;
               }
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
     <?php include '../includes/footer.php'; ?>
     <script data-cfasync="false" src="../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
     </script>
     <script src="../assets/js/plugins/jquery-3.6.0.min.js"></script>
     <script src=" ../assets/js/plugins/bootstrap.bundle.min.js"></script>
     <script src="../assets/js/plugins/slick.min.js"></script>
     <script src="../assets/js/plugins/jquery.magnific-popup.min.js"></script>
     <script src="../assets/js/plugins/jquery.counterup.min.js"></script>
     <script src="../assets/js/plugins/jquery.inview.min.js"></script>
     <script src="../assets/js/custom.js"></script>
</body>


</html>
<?php
if (isset($_POST['emailid'])) {
     $headers = "MIME-Version: 1.0\r\n";
     $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
     $token = uniqid();
     $url = "http://localhost/sout/includes/token?token=$token";
     $message = "Salut, pour modifier votre mot de passe veuillez cliquer : <a href=" . $url . ">ici</a>";
     if (mail($_POST['emailid'], 'Mot de passe oublié', $message, $headers)) {
          $sql = "UPDATE client set token = ? where emailid = ?";
          $stmt = $bdd->prepare($sql);
          $stmt->execute([$token, $_POST['emailid']]);
          $msg = "Verifier votre boite mail";
     } else {
          $error = "Oups!!! une erreur est survenu";
     }
}



?>