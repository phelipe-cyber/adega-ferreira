<?php
error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
include('header_novo.php');
include('conexao.php');
// include('Header_CSS_JS.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];

$pedido_excluir = $_POST['pedido_excluir'];

// print_r($_POST);

?>

<form action="salvar_pedido_int.php" method="POST" >
    <div class="modal fade" id="excluir">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Excluir pedido</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>
                    <div class="card-body table-responsive p-0">
                        <table id="dtBasicExample" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <input name="pedido_excluir" type="hidden" value="<?php echo $pedido_excluir ?>" class="form-control">
                                    <p style="font-size: larger;" class="text-center" scope="col">Certeza que deseja exluir o pedido ?</p>
                                    <p style="font-size: larger;" class="text-center" scope="col">Ao apertar no (SIM) não tera mais volta</p>

                                </tr>
                            </thead>

                        </table>
                </p>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button> -->
            <button type="submit" class="btn btn-success">SIM</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        </div>
    </div>
    </div>
</form>
<script>
    var senha = 0;

    if (senha != 1) {
        $('#excluir').modal('show');
    }
</script>
