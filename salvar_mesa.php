<?php
error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
include('conexao.php');
include('header_novo.php');
include('Header_CSS_JS.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];
$qtd = 0;
$id_status = 2;


$mesa = $_POST['mesa'];

if ($mesa == "") {
    exit();
} else {


    $inserir = "INSERT INTO `mesa`(`id`, `mesa`,`status`, `created_user`, `created_date`, `updated_at_user`, `updated_at`) VALUES
                 (null, '$mesa', '1', '$usuario', '$datahora', '$usuario', '$datahora')";

    $_salvar = mysqli_query($conexao, $inserir);

    // echo "<br>";
    // echo $inserir;
    // echo "<br>";

    if ($_salvar == 1) {
?>

        <form action="mesa.php" method="POST">

        <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">Salvo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>Salvo com sucesso &hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>    

        </form>
        <script>
            var senha = 0;

            if (senha != 1) {
                $('#modal-primary').modal('show');
            }
        </script>
    <?php
        echo '<meta http-equiv="refresh" content="3;URL=mesa.php?"/>';

        exit();
    } else {
    ?>

        <form action="mesa.php" method="POST">

        <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Erro</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p> Não foi possível salvar&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

        </form>
        <script>
            var senha = 0;

            if (senha != 1) {
                $('#modal-danger').modal('show');
            }
        </script>
<?php

    }
    exit();
}
?>

</body>
</div>
</body>
</div>

</html>