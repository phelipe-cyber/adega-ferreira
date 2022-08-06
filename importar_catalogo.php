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
$id_status = '1';
?>
<br>

<?php

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");
        $ok = 0;
        $erro = 0;
        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {


            if ($column[2] == 'preco')
            continue;           

            $sqlInsert = "INSERT INTO `catalogo`(`id`, `descricao`, `un.cx`, `preco`, `preco_compra`, `qtde_estoque`,`status`, 
            `created_user`, `created_date`, `updated_at_user`, `updated_at`) VALUES
        
                (NULL, '$column[0]','$column[1]','$column[2]','$column[3]','$column[4]','$id_status','$usuario','$datahora','$usuario','$datahora')";

              $result = mysqli_query($conexao, $sqlInsert);
           
            // echo "<br>";
            // echo $sqlInsert;
            // echo "<br>";

            if ($result == 1) {
                $ok = $ok + 1;
                $type1 = "success";
                $message1 = "Importado com sucesso: " . $ok;
            } else {
                $erro = $erro + 1;
                $type2 = "error";
                $message2 = "Erro na importação: " . $erro;
            }
        }
    }
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#frmCSVImport").on("submit", function() {
            $("#response").attr("class", "");
            $("#response").html("");
            var fileType = ".csv";
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
            if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
                $("#response").html("Arquivo invalido: <b>" + fileType + "</b> Ex. (1)");
                return false;
            }
            return true;
        });
    });
</script>

<body>
<div class="card-body">
    <div class="card mb-4">
        <div class="card-body">
        <div class="text-center">

    <form class="form-horizontal" action="importar_catalogo.php" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
        <div class="flex-center flex-column">
        <h6>Importar catalogo massivo</h6>
        <h5><?php echo "<a href='export_modelo.php' target='_blank' >Modelo de importação</a>"; ?></h5>

            <h6>Importar como CSV no formato UTF-8</h6>

            <div id="response" class="<?php if (!empty($type1)) {
                                            echo $type1 . " display-block";
                                        } ?>"><?php if (!empty($message1)) {
                                                    echo $message1;
                                                } ?></div>
            <div id="response" class="<?php if (!empty($type2)) {
                                            echo $type2 . " display-block";
                                        } ?>"><?php if (!empty($message2)) {
                                                    echo $message2;
                                                } ?></div>
            <div id="response" class="<?php if (!empty($type3)) {
                                            echo $type3 . " display-block";
                                        } ?>"><?php if (!empty($message3)) {
                                                    echo $message3;
                                                } ?></div>

            
                <div class="row-sm5">
                    <div class="input-row">
                        <div class="custom-file">
                            <input type="file" name="file" id="file" accept=".csv" class="custom-file-input" id="customFileLangHTML">
                            <label class="custom-file-label" for="customFileLangHTML" data-browse="Bucar">Selecionar Arquivo</label>
                        </div>
                    </div>
                </div>
           
        </div>

       <br>
            <!-- Material input -->
            <div class="md-form mt-0">
                <button type="submit" name="import" class="btn btn-success">Importar</button>
            </div>
        
        </div>
        </div>
    </form>
</body>