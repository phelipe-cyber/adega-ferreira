<?php
session_start();
include('conexao.php');

$datahora = (date('d-m-Y_H:i:s'));

$arquivo = $datahora . '_' . 'catalogo.xls';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= {$arquivo}");

?>
<style>
    table {
        border-collapse: collapse;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }
</style>

<table>
    <thead>
        <tr>
            <th class="th-sm"><?php echo utf8_decode("Catalogo"); ?></th>
            <th class="th-sm"><?php echo utf8_decode("Un.cx"); ?></th>
            <th class="th-sm"><?php echo utf8_decode("Qtde. Estoque"); ?></th>
            <th class="th-sm"><?php echo utf8_decode("Preço"); ?></th>
            <th class="th-sm"><?php echo utf8_decode("Preço Compra"); ?></th>
            <th class="th-sm"><?php echo utf8_decode("Data Hora"); ?></th>
            <th class="th-sm"><?php echo utf8_decode("Status"); ?></th>
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
                <td>
                    <?php echo $status ?>
                </td>
            </tr>
        <?php
            $index++;
        }
        ?>

    </tbody>
</table>