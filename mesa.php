<?php
error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
include('header_novo.php');
// include('Header_CSS_JS.php');
include('conexao.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];


?>


<div class="text-center">
    <!-- <a class="logo"><img src="/images-on-off/adega_logo.png" height="250" width="300"> -->
</div>    
<div class="card-body">
    <div class="card-deck">
        <div class="card mb-4">
            <div class="card-body">
            <form action="salvar_mesa.php" method="POST">


            <div class="card-body text-center">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                  Nova
                </button>
            </div>

            <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nova mesa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>
              
              <div class="form-group">
                        <label>Mesa</label>
                        <input type="number" name="mesa" class="form-control" placeholder="" required>
                      </div>

              </p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

</form>


<form action="alterar_mesa.php" method="POST">

<div class="card-body">
    <div class="card-deck">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                    
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Mesas</h3>

                <div class="card-tools">
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/pages/widgets.html" data-source-selector="#card-refresh-content"><i class="fas fa-sync-alt"></i></button> -->
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <table id="example1" class="table table-bordered table-striped table-reponsive">
            <thead>
                <tr style="text-align:center">
                    <th>Mesa</th>
                    <th>Data Hora</th>
                    <th>Status</th>
                    <th>Farol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result_usuarios = ("SELECT * FROM `mesa`");
                $recebidos = mysqli_query($conexao, $result_usuarios);
                $index = 0;
                while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                    if ($row_usuario['status'] == 1) {
                        $status = "Ativo";
                    } else {
                        $status = "Desativado";
                    }
                ?>
                    <tr style="text-align:center">

                        <td>
                            <?php echo $row_usuario['mesa']?>
                        </td>
                        <td>
                             <?php echo date('d/m/Y H:i:s', strtotime($row_usuario['created_date'])) ?>
                             </td>
                        <input name="pecadetalhe[<?= $index ?>][id]" class="input is-large" value="<?php echo $row_usuario['id']?>" type="hidden">

                        <td>
                        
                            <select id="inputState" class="browser-default custom-select" name="pecadetalhe[<?= $index ?>][status]" class="col-md-12 p-0" data-live-search="true">
                                <option selected disabled><?php echo $status ?></option>

                                <?php if ($row_usuario['status'] <= 0) {
                                ?> <option value='1'> <?php echo "Ativar"; ?></option> <?php
                                                                            } else {
                                                                                ?> <option value='0'> <?php echo "Desativar"; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <?php

                            ?>
                            <?php if ($row_usuario['status'] <= 0) {
                            ?> <a class="logo"><img src="/images-on-off/off.png" height="40" width="40" /> </a> <?php
                                                                                                    } else {
                                                                                                        ?> <a class="logo"><img src="/images-on-off/on.png" height="40" width="40" /> </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                    $index++;
                }
                ?>
            </tbody>
</div>
        </table>
        <div class="container-fluid">
                <div class="row">
                    <div class="card card-info">
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-block btn-success">Salvar Alterações</button>
                            </td>
                        </tr>
                    </div>
                </div>
            </div>
    </form>
</head>
</div>
</html>
<br><br>