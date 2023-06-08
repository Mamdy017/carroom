<?php
session_start();
error_reporting(0);
include('../includes/config.php');
$bdd = pdo_connect_mysql();
if (strlen($_SESSION['login']) == 0) {
    header('location:../index.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets2/img/apple-icon.png">
        <title>

        </title>
        <?php include "../includes/css2.php";  ?>

        <link href="../Admin/assets/css/app.css" rel="stylesheet">
        <link href="../Admin/assets/css/icons.css" rel="stylesheet">
        <link rel="shortcut icon" href="../assets/images/icon/favicon.png">
        <link id="pagestyle" href="../assets2/css/soft-ui-dashboard.minc924.css?v=1.0.6" rel="stylesheet" />

        <link rel="icon" type="image/png" sizes="32x32" href="../favicon.ico">


    </head>

    <body style="background-color:#F6F6F6;" class="g-sidenav-show  bg-gray-10">

        <?php include "../includes/latbard.php"; ?>
        <style>
        </style>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
                <div style="background-color:#FFFFFF;" class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li> -->
                            <li class="breadcrumb-item text-sm text-dark " aria-current="page">Location</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Mes demandes de reservation de location</h6>
                    </nav>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Recherche...">
                            </div>
                        </div>
                        <?php include '../includes/naves.php'; ?>
                    </div>
                </div>
            </nav>
            <div class="container-fluid" id="imprimer">
                <?php include "../includes/css2.php";  ?>
                <?php include "../assets2/css/style2.php"; ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class=" row mx-5 receipt-main  col-md-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                            <div class="row  col-7">
                                <div class="row receipt-header">
                                    <div class="col-xs-4 col-sm-4 col-md-2">
                                        <div class="receipt-left">
                                            <img class="img-responsive" alt="iamgurdeeposahan" src="../image/<?php echo htmlentities($result->photo); ?>" style="width: 71px; border-radius: 50px;">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 mx-4 col-sm-6 col-md-8 text-right">
                                        <div class="receipt-right">
                                            <h5>Client</h5>
                                            <p style="font-weight:bold">Nom: <b style="font-weight:normal"> <?php echo htmlentities($result->nom); ?></b></p>
                                            <p style="font-weight:bold">Prenom: <b style="font-weight:normal"><?php echo htmlentities($result->prenom); ?></b></p>
                                            <p style="font-weight:bold">Telephone:<b style="font-weight:normal"> <?php echo htmlentities($result->telephone); ?></b></p>
                                            <p style="font-weight:bold">Email:<b style="font-weight:normal"><?php echo htmlentities($result->emailid); ?></b></p>
                                            <p style="font-weight:bold">Ville: <b style="font-weight:normal"><?php echo htmlentities($result->ville_provenence); ?></b></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class=" col-5">
                                <div class="row  receipt-header receipt-header-mid">
                                    <div class="col-xs-4 col-sm-4 col-md-2">
                                        <div class="receipt-left">
                                            <img src="../assets/images/icon/fa.png" alt="logo" style="width: 71px; border-radius: 50px;">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 mx-4 col-md-7 text-right">
                                        <div class="receipt-right">
                                            <h5>Car <b style="color:red;">room</b> </h5>
                                            <p><b>Telephone :</b></p>
                                            <p><b>Email:</b>carroom@gmail.com</p>
                                            <p><b>Address :</b>Bamako</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="tabl align-items-center mb-0">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Information</th>
                                            <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Les valeurs</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $useremail = $_SESSION['login'];
                                    $id = $_GET['id'];
                                    $sql = "SELECT reservation.id, reservation.quantite as quantite, reservation.chauffeur as chauffeur,reservation.total, vehicule.img1 as photo1,vehicule.nom,vehicule.id_vehi ,vehicule.marque as vid,
                                            reservation.debut,reservation.fin,reservation.message,reservation.statut,vehicule.prixparjour,DATEDIFF(reservation.fin,reservation.debut) as totaldays,reservation.num 
                                             from reservation join vehicule on reservation.id_vehi=vehicule.id_vehi  where
                                             reservation.email=:useremail AND reservation.id=:id AND type=1 order by  reservation.id desc";
                                    $query = $bdd->prepare($sql);
                                    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                    ?>
                                            <tbody style="">
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Nom</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($result->nom); ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="">
                                                        <h5 style="font-size: 15px;">Photo</h5>
                                                    </th>
                                                    <td><img src="../admin/img/voitureimages/<?php echo htmlentities($result->photo1); ?>" alt="image" class="avatar avatar-sm me-4" alt="user2"></td>
                                                </tr>
                                                <tr>
                                                    <th class="">
                                                        <h5 style="font-size: 15px;">Date-debut</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($result->debut); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Date-fin</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($result->fin); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Total-Jours</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($tds = $result->totaldays); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Quantité</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($result->quantite); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Prix/Jour</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($ppd = $result->prixparjour); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Chauffeur</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($result->chauffeur); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 20px; color:red ">Total</h5>
                                                    </th>
                                                    <td style="color:red;"><?php echo htmlentities($result->total); ?></td>
                                                </tr>
                                            </tbody>
                                    <?php                                                     }
                                    } ?>
                                    <?php
                                    $useremail = $_SESSION['login'];
                                    $id = $_GET['id'];
                                    $sql = "SELECT reservation.id, reservation.quantite as quantite, reservation.chauffeur as chauffeur,reservation.total, vehicule.img1 as photo1,vehicule.nom,vehicule.id_vehi ,vehicule.marque as vid,
                                            reservation.debut,reservation.fin,reservation.message,reservation.statut,vehicule.prixparjour,DATEDIFF(reservation.fin,reservation.debut) as totaldays,reservation.num 
                                             from reservation join vehicule on reservation.id_vehi=vehicule.id_vehi  where
                                             reservation.email=:useremail AND reservation.id=:id AND type=2 order by  reservation.id desc";
                                    $query = $bdd->prepare($sql);
                                    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                    ?>
                                            <tbody style="">
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Nom</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($result->nom); ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="">
                                                        <h5 style="font-size: 15px;">Photo</h5>
                                                    </th>
                                                    <td><img src="../admin/img/voitureimages/<?php echo htmlentities($result->photo1); ?>" alt="image" class="avatar avatar-sm me-4" alt="user2"></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Quantité</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($result->quantite); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 15px;">Prix/unitaire</h5>
                                                    </th>
                                                    <td><?php echo htmlentities($ppd = $result->prixparjour); ?></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        <h5 style="font-size: 20px; color:red ">Total</h5>
                                                    </th>
                                                    <td style="color:red;"><?php echo htmlentities($result->total); ?></td>
                                                </tr>
                                            </tbody>


                                        <?php
                                        }
                                    } else  ?>
                                        <h5 align="center" style="color:red"></h5>
                                    <?php
                                    ?>
                                </table>
                            </div>

                            <div class="row">
                                <div class="row receipt-header receipt-header-mid receipt-footer">
                                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                                        <div class="receipt-right">
                                            <h5 style="color: rgb(140, 140, 140);">Merci pour la reservation!</h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-4 text-left">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="receipt-right pdf">
                <p><b>Telecharger le pdf</b> <i class="fa fa-download" style="font-size:20px; padding-left:10px" onclick="imprimer();"></i></p>
            </div>
        </main>
        <script src="../assets2/js/core/popper.min.js"></script>
        <script src="../assets2/js/core/bootstrap.min.js"></script>
        <script src="../assets2/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets2/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <script async defer src="../../../buttons.github.io/buttons.js"></script>
        <script src="../assets2/js/soft-ui-dashboard.minc924.js?v=1.0.6"></script>
    </body>

    </html>
<?php } ?>

<script type="text/javascript">
    function imprimer() {
        var imprimer = document.getElementById('imprimer');
        var popupcontenu = window.open('', '_blank');
        popupcontenu.document.open();
        popupcontenu.document.write('<html><body onload="window.print()">' + imprimer.innerHTML + '</html>');
        popupcontenu.document.close();
    }
</script>