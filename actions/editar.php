<?php
include_once("../config/database/database.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE FROM contatos SET nome='$nome', email='$email', telefone='$telefone' WHERE id = ".$_GET['id'];

    $con->query($sql);
    header("Location: ../index.php");
    exit();

}

$sql ="SELECT * FROM contatos WHERE id = ".$_GET['id'];
$rows = $con->query($sql);
if($rows->num_rows > 0){
    $row = $rows->fetch_assoc();
    $nome = $row['nome'];
    $email = $row['email'];
    $telefone = $row['telefone'];
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<form method="POST">
    <div class="container" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar contato</h1>
      </div>
      <div class="modal-body">
      <div class="mb-3 form-floating">
        <input name="nome" type="text" value="<?=$nome?>" class="form-control" id="exampleFormControlInput1" placeholder="" value="" required>
        <label for="exampleFormControlInput1">Nome</label>
      </div>
      <div class="mb-3 form-floating">
        <input name="email" type="email" value="<?=$email?>" class="form-control" id="exampleFormControlInput2" placeholder="" value="" required>
        <label for="exampleFormControlInput2">E-mail</label>
      </div>
      <div class="mb-3 form-floating">
        <input name="telefone" maxlength="14" value="<?=$telefone?>" type="text" class="form-control" id="exampleFormControlInput3" placeholder="" value="" required>
        <label for="exampleFormControlInput3">Telefone</label>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-person-badge"></i>
          Salvar contato
        </button>
      </div>
    </div>
  </div>
</div>
</form>