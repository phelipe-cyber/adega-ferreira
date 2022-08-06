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

<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"> </script>


<div class="text-center">
    <!-- <a class="logo"><img src="/images-on-off/adega_logo.png" height="250" width="300"> -->
</div>
<div class="card-body">
    <div class="card-deck">
        <div class="card mb-4">
            <div class="card-body">
                <form action="salvar_catalogo.php" method="POST">


                    <div class="card-body text-center">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                            Novo
                        </button>
                    </div>

                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Novo catalogo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        <div class="md-form mb-5">
                                            <div class="form-group">
                                                <label>Catalogo</label>
                                                <input required="" type="text" name="catalogo" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Unidade caixa ou Unitario</label>
                                                <input required="" value="<?php echo $row_usuario['un.cx'] ?>" type="number" min="0" name="uncx" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Preço de compra</label>
                                                <input required="" type="number" name="preco_compra" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Preço de venda</label>
                                                <input required="" type="number" name="preco" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Qtde. para o Estoque</label>
                                                <input required="" type="number" min="0" name="qtde_estoque" class="form-control" placeholder="">
                                            </div>
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


                <form action="alterar_catalogo.php" method="POST">

                    <div class="card-body">
                        <div class="card-deck">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">

                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Catalogo</h3>

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
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr style="text-align:center">
                                                                <th>Catalogo</th>
                                                                <th>Un.CX</th>
                                                                <th>Qtde. Estoque</th>
                                                                <th>Preço</th>
                                                                <th>Preço Compra </th>
                                                                <th>Data Hora</th>
                                                                <th>Status</th>
                                                                <th>Farol</th>
                                                                <th>Ação</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $result_usuarios = ("SELECT * FROM `catalogo`");
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
                                                                        <?php echo $row_usuario['descricao'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row_usuario['un.cx'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row_usuario['qtde_estoque'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row_usuario['preco'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row_usuario['preco_compra'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo date('d/m/Y H:i:s', strtotime($row_usuario['created_date'])) ?>
                                                                    </td>
                                                                    <input name="pecadetalhe[<?= $index ?>][id]" class="input is-large" value="<?php echo $row_usuario['id'] ?>" type="hidden">

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

                                                                    <td class="text-center">
                                                                        <a href="modal_catalogo.php?id_alterar=<?php echo $row_usuario['id'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fa fa-eye"></i></a>
                                                                    </td>


                                                                </tr>
                                                            <?php
                                                                $index++;
                                                            }
                                                            ?>
                                                        </tbody>

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
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                </head>
            </div>

            </html>