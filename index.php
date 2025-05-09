<?php
  include_once("./config/database/database.php");
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>CRUD - AGENDA</title>
  </head>
  <body class="container">
    <h1 class="text-center py-4">
    <i class="bi bi-telegram"></i>
    Agenda Telefonica
  </h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="bi bi-plus-circle"></i>  
    Adicionar novo contato
    </button>
    
  <table class="table table-striped table-hover table-bordered mt-4">
  <thead>
    <tr class="text-center">
      <th scope="col">#</th>
      <th scope="col"><i class="bi bi-person p-2"></i>Nome</th>
      <th scope="col"><i class="bi bi-envelope p-2"></i>E-mail</th>
      <th scope="col"><i class="bi bi-whatsapp p-2"></i>Telefone/Whatsapp</th>
      <th scope="col">Ações</th>
    </tr> 
  </thead>
  <tbody>
    <?php
      $por_pagina = 10;
      $pagina = $_GET['pagina'] ?? 1;
      $inicio = ($pagina - 1) * $por_pagina;

      $sql = "SELECT * FROM contatos ORDER BY id DESC LIMIT $inicio, $por_pagina"; 
      $rows = $con->query($sql);
      if($rows->num_rows > 0){
        while($row = $rows->fetch_assoc()){
          echo '
            <tr class="text-center">
              <th scope="row">'.$row['id'].'</th>
              <td>'.$row['nome'].'</td>
              <td>'.$row['email'].'</td>
              <td>'.$row['telefone'].'</td>
              <td>
                <a class="btn btn-danger" href="actions/deletar.php?id='.$row['id'].'">
                  <i class="bi bi-trash"></i>
                  Deletar
                </a>

                <a class="btn btn-primary" href="actions/editar.php?id='.$row['id'].'">
                  <i class="bi bi-eye"></i>
                  Editar
                </a>

              </td>
            </tr>';
        }
      }
    ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4">
        <?php
          $total = $con->query("SELECT COUNT(*) as total FROM contatos")->fetch_assoc()['total'];

          $total_paginas = ceil($total / $por_pagina);
          echo '<nav>
        <ul class="pagination justify-content-center">';

          for($i = 1; $i <= $total_paginas; $i++){
            $active = ($i == $pagina) ? 'active' : '';
          echo '<li class="page-item '.$active.'"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
          }
          echo '</ul></nav>';
        ?>
      </td>
    </tr>
  </tfoot>
  
</table>

    <form method="POST" action="actions/salvar.php">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Novo contato</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3 form-floating">
        <input name="nome" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="" required>
        <label for="exampleFormControlInput1">Nome</label>
      </div>
      <div class="mb-3 form-floating">
        <input name="email" type="email" class="form-control" id="exampleFormControlInput2" placeholder="" value="" required>
        <label for="exampleFormControlInput2">E-mail</label>
      </div>
      <div class="mb-3 form-floating">
        <input name="telefone" maxlength="14" type="text" class="form-control" id="exampleFormControlInput3" placeholder="" value="" required>
        <label for="exampleFormControlInput3">Telefone</label>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">  
          <i class="bi bi-x-circle-fill"></i>
          Fechar
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-person-badge"></i>
          Salvar contato
        </button>
      </div>
    </div>
  </div>
</div>
</form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#exampleFormControlInput3').mask('(00)0000-0000');
        $('.modal').on('hidden.bs.modal', function() {
          $(this).find('input').val('');
        });
      });
    </script>
  </body>
</html>