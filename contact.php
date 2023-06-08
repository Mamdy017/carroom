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
    <div class="section contact" id="contact">
        <div id="map" class="map"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-form-card">
                        <h4 class="contact-title">Envoyer un message</h4>
                        <form action="" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="nom" placeholder="Nom *" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="tel" placeholder="Numero  *" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email *" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="msg" id=" placeholder=" Message *" rows="5" required></textarea>
                            </div>
                            <div class="form-group ">
                                <button type="submit" name="submit" class="form-control btn btn-primary">Envoyer le message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-info-card">
                        <h4 class="contact-title">Nos coodonnées</h4>
                        <div class="row mb-2">
                            <div class="col-1 pt-1 mr-1">
                                <i class="ti-mobile icon-md"></i>
                            </div>
                            <div class="col-10 ">
                                <h6 class="d-inline">Tel : <br> <span class="text-muted">+ (223) 91228829</span></h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-1 pt-1 mr-1">
                                <i class="ti-map-alt icon-md"></i>
                            </div>
                            <div class="col-10">
                                <h6 class="d-inline">Adresse :<br> <span class="text-muted">Hamdallaye Aci 2000</span></h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-1 pt-1 mr-1">
                                <i class="ti-envelope icon-md"></i>
                            </div>
                            <div class="col-10">
                                <h6 class="d-inline">Email :<br> <span class="text-muted">mamdy017@gmail.com</span></h6>
                            </div>
                        </div>
                        <ul class="social-icons pt-4">
                            <li class="social-item"><a class="social-link text-dark" href="#"><i class="ti-facebook" aria-hidden="true"></i></a></li>
                            <li class="social-item"><a class="social-link text-dark" href="#"><i class="ti-twitter" aria-hidden="true"></i></a></li>
                            <li class="social-item"><a class="social-link text-dark" href="#"><i class="ti-google" aria-hidden="true"></i></a></li>
                            <li class="social-item"><a class="social-link text-dark" href="#"><i class="ti-instagram" aria-hidden="true"></i></a></li>
                            <li class="social-item"><a class="social-link text-dark" href="#"><i class="ti-github" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
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