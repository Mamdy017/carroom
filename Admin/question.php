<?php

if (isset($_POST['msg'])) {

  if (empty($_POST['msg'])) {
    echo "<script>alert(' Le champ message est obligatoire');</script>";
  } else {
    $id = intval($_GET['id']);
    $statut = 1;
    $emailid = $_SESSION['user'];
    $statut2 = 2;
    $mesg = $_POST['msg'];
    $sql = "update question set statut=:status where id=:id";
    $query = $bdd->prepare($sql);
    $query->execute(array('status' => $statut, 'id' => $id,));
    if ($query) {
      $insert = $bdd->prepare('INSERT INTO question ( `emailid`, `message`,`statut`,`id_question`)
            VALUES (?,?,?,?)');
      $insert->execute(array($emailid, $mesg, $statut2, $id));
      if ($insert) {
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
<div id="openModal" class="modalDialog">
  <div>
    <a href="#close" title="Close" class="close">X</a>
    <form action="#" method="POST" class="user_form">
      <div class="row">
        <div class="form-group">
          <label for="">Formuler une reponse</label>
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