    <?php
    session_start();
    $datahora = (date('d-m-Y_H:i:s'));
    $arquivo = $datahora . '_' . 'modelo.xls';
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
                <th class="th-sm"><?php echo utf8_decode("Descricao"); ?></th>
                <th class="th-sm"><?php echo utf8_decode("Un.cx"); ?></th>
                <th class="th-sm"><?php echo utf8_decode("Preco"); ?></th>
                <th class="th-sm"><?php echo utf8_decode("Preco Compra"); ?></th>
                <th class="th-sm"><?php echo utf8_decode("Qtde Estoque"); ?></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td> <?php echo utf8_decode("Agua de Coco 200 ml") ?> </td>
                <td> <?php echo utf8_decode("27") ?> </td>
                <td> <?php echo utf8_decode("2.00") ?> </td>
                <td> <?php echo utf8_decode("1.05") ?> </td>
                <td> <?php echo utf8_decode("2") ?> </td>
            </tr>
            <tr>
                <td> <?php echo utf8_decode("Brahma 260 ml") ?> </td>
                <td> <?php echo utf8_decode("12") ?> </td>
                <td> <?php echo utf8_decode("3.00") ?> </td>
                <td> <?php echo utf8_decode("1.89") ?> </td>
                <td> <?php echo utf8_decode("30") ?> </td>
            </tr>
        </tbody>
    </table>