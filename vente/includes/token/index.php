<?php
require_once '../config.php';
$bdd = pdo_connect_mysql();
if (isset($_GET['token']) && $_GET['token'] != '') {
     $stmt = $bdd->prepare('SELECT emailid from client WHERE token= ?');
     $stmt->execute([$_GET['token']]);
     $emailid = $stmt->fetchColumn();
     if ($emailid) {
?>
          <!DOCTYPE html>
          <html>

          <head>
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <title>Carrom || modifier le mot de passe</title>
               <link rel="stylesheet" href="style.css">
               <link rel="shortcut icon" href="../../assets/images/icon/favicon.png">
          </head>

          <body>
               <h2>Modifier le mot de passe</h2>
               <form method="post">
                    <div class="container">
                         <label for="pass"><b>Nouveau mot de passe</b></label>
                         <input type="password" name="pass" required>
                         <label for="password"><b>confirmer mot de passe</b></label>
                         <input type="password" name="pass2" required>
                         <button type="submit">Connexion</button>
                    </div>
               </form>
          </body>

          </html>
<?php
     }
}
if (isset($_POST['pass']) && isset($_POST['pass2'])) {
     $pass = $_POST['pass'];
     $pass2 = $_POST['pass2'];
     if ($pass === $pass2) {
          $pass = hash('sha256', $pass);
          $sql = "UPDATE client set password = ?, token=null where emailid = ?";
          $stmt = $bdd->prepare($sql);
          $stmt->execute([$pass, $emailid]);
          header('location:..\..\connexion.php');
     } else {
          echo 'Mot de passe non identique';
     }
}



?>