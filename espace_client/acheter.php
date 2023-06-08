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

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
                <div style="background-color:#FFFFFF;" class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li> -->
                            <li class="breadcrumb-item text-sm text-dark " aria-current="page">Achéter</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Mes demandes de reservation d'achats</h6>
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
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table id="example" class="tabl align-items-center mb-0">
                                        <style>
                                            table {
                                                border: 1px solid black;
                                                border-collapse: collapse;
                                                background: #FFF;

                                            }

                                            thead {
                                                border: 1px solid black;
                                                border-collapse: collapse;
                                            }

                                            thead {
                                                background: dark;
                                                border-collapse: collapse;
                                            }

                                            tbody {
                                                border: 1px solid black;
                                                border-collapse: collapse;
                                            }

                                            table {
                                                border-collapse: collapse;
                                            }

                                            th,
                                            td {
                                                text-align: center;
                                                width: 10%;
                                                border: 1px solid #DEE2E6;
                                            }
                                        </style>
                                        <thead>
                                            <tr class="bg-dark">
                                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Voiture</th>
                                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">N°:reservation</th>
                                                <!-- <th class="text-secondary opacity-7">Total-Jours</th> -->
                                                <!--  -->
                                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Prix/unitaire</th>
                                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Nombre</th>
                                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Total</th>
                                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">statut</th>
                                            </tr>
                                        </thead>
                                        <tbody style="">
                                            <?php
                                            $useremail = $_SESSION['login'];
                                            $sql = "SELECT reservation.id,reservation.total,reservation.quantite as quantite, vehicule.img1 as photo1,vehicule.nom,vehicule.id_vehi ,vehicule.marque as vid,reservation.debut,reservation.fin,reservation.message,reservation.statut,vehicule.prixparjour,DATEDIFF(reservation.fin,reservation.debut) as totaldays,reservation.num  from reservation join vehicule on reservation.id_vehi=vehicule.id_vehi  where reservation.email=:useremail AND type=2 order by  reservation.id desc";
                                            $query = $bdd->prepare($sql);
                                            $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="../admin/img/voitureimages/<?php echo htmlentities($result->photo1); ?>" alt="image" class="avatar avatar-sm me-4" alt="user2">
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm"><?php echo htmlentities($result->nom); ?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($result->num); ?></p>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($ppd = $result->prixparjour); ?></p>
                                                        </td>
                                                        <td class="align-middle">
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($result->quantite); ?></p>
                                                        </td>
                                                        </td>
                                                        <td class="align-middle">
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($result->total); ?></p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <?php if ($result->statut == 1) { ?>
                                                                <span class="badge badge-sm bg-gradient-success">Confirmer <a href="recu.php?id=<?php echo $result->id; ?>" style="color:red">Reçu</a></span>
                                                            <?php
                                                            } else if ($result->statut == 2) { ?>
                                                                <span class="badge badge-sm bg-gradient-danger">Annuler</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-sm bg-gradient-info">Encours...</span>
                                                            <?php } ?>
                                                        </td>

                                                    </tr>


                                                <?php
                                                }
                                            } else { ?>
                                                <h5 align="center" style="color:red">Pas de reservation</h5>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="../assets2/js/core/popper.min.js"></script>
        <script src="../assets2/js/core/bootstrap.min.js"></script>
        <script src="../assets2/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets2/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="../Admin/assets/js/jquery.min.js"></script>
        <script src="../Admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="../Admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
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