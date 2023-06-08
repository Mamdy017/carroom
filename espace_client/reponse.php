<?php

$id = intval($_GET['id']);

$sql = "SELECT * from question where id_question=:id";
$query = $bdd->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0) {
  foreach ($results as $contact) {
    $message = $contact->message;
  }
}

if (isset($_POST['ok'])) {
  $statut = 3;
  $emailid = $_SESSION['user'];
  $statut2 = 2;
  $mesg = $_POST['msg'];
  $sql = "update question set statut=:status where id_question=:id";
  $query = $bdd->prepare($sql);
  $query->execute(array('status' => $statut, 'id' => $id));
  if ($query) {
    $sql = "update question set statut=:status where id=:id";
    $query = $bdd->prepare($sql);
    $query->execute(array('status' => $statut, 'id' => $id));
    echo "merci";
  } else {
    echo "pas trouver";
  }
} else {
  "merde";
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
</style>
<div id="openModal" class="modalDialog">
  <div>


    <form action="#" method="POST" class="user_form">
      <button class="close" type="submit" name="ok">OK</button>
      <a href="#close" title="Close"></a>
      <div class="row">
        <div class="form-group">
          <textarea class="form-control" name="msg" placeholder="<?php echo $message; ?>" rows="5"></textarea>
        </div>
      </div> <br>
    </form>
  </div>
  <form action="">
    <a href="#close" title="Close" class="close">ok</a>
  </form>

</div>