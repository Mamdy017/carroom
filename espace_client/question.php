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
                            <li class="breadcrumb-item text-sm text-dark " aria-current="page">Message</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Mes questions et reponses</h6>
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
            <?php include 'reponse.php'; ?>
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
                                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">N°</th>
                                                <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">question</th>
                                                <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Reponse</th>
                                                <!-- <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Date-fin</th> -->
                                                <!-- <th class="text-secondary opacity-7">Total-Jours</th> -->
                                                <!-- <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Total-Jours</th> -->
                                                <!--  -->
                                                <!-- <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Prix/Jour</th>
                                                    <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">Total</th>
                                                    <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2" >statut</th> -->
                                            </tr>
                                        </thead>
                                        <tbody style="">


                                            <?php
                                            $useremail = $_SESSION['login'];
                                            $sql = "SELECT * FROM `question` WHERE question.emailid=:useremail";
                                            $query = $bdd->prepare($sql);
                                            $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            $i = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlentities($result->message); ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                <?php
                                                                if ($result->statut == 1) { ?>
                                                                    <!-- <i class="fa fa-check" style="color:#64C9BF;"></i> Répondu -->
                                                                    <a href="question.php?id=<?php echo htmlentities($result->id); ?>#openModal" style="color: #54A7E3;">
                                                                        <button class=" btn-primary"> Voir reponse</button> </a>

                                                                <?php  } else if ($result->statut == 0) { ?>
                                                                    <span>
                                                                        Non repondu
                                                                    </span>
                                                                <?php } else if ($result->statut == 3) { ?>
                                                                    <span>vu</span>
                                                                <?php } ?>
                                                            </p>
                                                        </td>
                                                    </tr>
                                            <?php }
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