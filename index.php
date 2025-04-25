<?php
include_once("./config/database/database.php");

$query = "SELECT * FROM contatos ORDER BY id DESC";
$result = $con->query($query);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD - AGENDA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body class="container">
    <p class="h1 text-center py-4">Agenda Telefonica</p>
     <!-- Button trigger modal -->
     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Adicionar Contato
    </button>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <td class="h6 text-start py-4">
                  Nome
                </td>
                <td class="h6 text-start py-4">
                  Email
                </td>
                 <td class="h6 text-start py-4">
                  Telepone
                </td>
            </tr>
        </thead>
        <tbody>

        <?php
        
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
            <td>".$row['nome']."</td>
            <td>".$row['email']."</td>
            <td>".$row['telefone']."</td>
          </tr>"  ;
        } 

        ?>
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="salvar.php" method="POST">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Contato</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="form-control">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="exampleFormControlInput1" placeholder="Nome completo">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="nome@mail.com">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                <input type="tel" class="form-control" name="tel" id="exampleFormControlInput1" placeholder="(88) 9999-9999">
              </div>
           </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
        </div>
      </div>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>