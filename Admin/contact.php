<?php
$id = intval($_GET['id']);

$sql = "SELECT * from contact where id_contact=:id";
$query = $bdd->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
$useremail = $contact->emailid;

if ($query->rowCount() > 0) {
  foreach ($results as $contact) {
    echo htmlentities($contact->emailid);
  }
}
if (isset($_POST['msg'])) {
  if (empty($_POST['msg'])) {
    echo "<script>alert('Le champ message ne peut pas être vide');</script>";
  } else {
    $statut = 1;
    $emailid = $_SESSION['user'];
    $statut2 = 2;
    $mesg = $_POST['msg'];
    $sql = "update contact set statut=:status where id_contact=:id";
    $query = $bdd->prepare($sql);
    $query->execute(array('status' => $statut, 'id' => $id));
    if ($query) {
      $insert = $bdd->prepare('INSERT INTO contact ( `emailid`, `message`,`statut`,`id_contact1`)
            VALUES (?,?,?,?)');
      $insert->execute(array($emailid, $mesg, $statut2, $id));
      if ($insert) {
        $subject = "Reponse aux questions ";
        $headers = " Content-Type: textpain; charset-utf-8\r\n";
        $headers = "From: mamdy6091@gmail.com";
        if (mail($useremail, $subject, $mesg, $headers))

          "envoyé!";
        header('Location: dashbord.php');
      } else {
        $error = "Une erreur s'est produite. essayez encore";
      }
    } else {
      echo "mal";
    }
  }
}
?>
<style>
  .modalDialog>div {
    width: 400px;
    position: relative;
    margin: 10% auto;
    padding: 5px 20px 13px 20px;
    border-radius: 10px;
    border: 3px solid #498DFF;
  }

  .modalDialog {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.1);
    z-index: 99999;
    opacity: 0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    pointer-events: none;
  }

  .modalDialog:target {
    opacity: 1;
    pointer-events: auto;
  }

  .close {
    background: #606061;
    color: #ffffff;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 24px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
  }

  .close:hover {
    background: #6ed1d8;
  }

  button {
    background-color: #498DFF;
    height: 20px;
    color: white;
  }

  label {
    color: #498DFF;
    margin-left: 100px;
    font-size: 20px;
  }
</style>
<div id="openModal1" class="modalDialog">
  <div>
    <a href="#close" title="Close" class="close">X</a>
    <form action="#" method="POST" class="user_form">
      <div class="row">
        <div class="form-group">
          <label for="">Formuler une reponse </label>
          <textarea class="form-control" name="msg" placeholder="Message " rows="5"></textarea>
        </div>
      </div> <br>
      <div class="col-12">
        <button type="submit" class=" w-100 pm" name='valider'>Envoyer la reponse</button>
      </div>
    </form>
  </div>
  <a href="#close" title="Close" class="close">x</a>
</div>