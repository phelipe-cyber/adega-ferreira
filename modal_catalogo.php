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

$id_busca = $_GET['id_alterar'];

$result_usuarios = ("SELECT * FROM `catalogo` where id = $id_busca ");
$recebidos = mysqli_query($conexao, $result_usuarios);

?>
<form action="alterardadoscatalogo.php" method="POST">
    <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alterar dados do catalogo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>

                        <?php
                        while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                        ?>
                            <div class="md-form mb-5">
                                <div class="form-group">
                                    <label>Catalogo</label>
                                    <input  value="<?php echo $row_usuario['id'] ?>" type="hidden" name="id" class="form-control" placeholder="">
                                    <input required="" value="<?php echo $row_usuario['descricao'] ?>" type="text" name="catalogo" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Preço de compra</label>
                                    <input required="" value="<?php echo $row_usuario['preco_compra'] ?>" type="text" name="preco_compra" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Preço de venda</label>
                                    <input required="" value="<?php echo $row_usuario['preco'] ?>" type="text" name="preco" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Qtde. para o Estoque</label>
                                    <input required="" value="<?php echo $row_usuario['qtde_estoque'] ?>" type="number" min="0" name="qtde_estoque" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Unidade caixa ou Unitario</label>
                                    <input required="" value="<?php echo $row_usuario['un.cx'] ?>" type="number" min="0" name="uncx" class="form-control" placeholder="">
                                </div>
                            </div>
                        <?php } ?>
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

<script>
    var senha = 0;

    if (senha != 1) {
        $('#modal-editar').modal('show');
    }
</script>