<?php include APPPATH .'views/admin/include/header.php' ?>
<?php echo validation_errors();
if(isset($table_1, $table_2))
{
    echo form_open('http://ajd-ci.com/admin/cReport/create');
}
else
{
    echo form_open('http://ajd-ci.com/admin/cReport/getCols');
}
?>

<p id="text"></p>
<table>
    <tr>
        <td colspan="2"><h3>Nazwa raportu</h3></td>
    </tr>
    <tr>
        <td colspan="2"><?php echo form_input(array(
                'name' => 'name',
                'type' => 'text',
                'class' => 'form-control'
            )); ?></td>
        <!--            <input id="text2" type="textbox" value="Type something">-->
        <td><?php echo form_input('cols', '', 'hidden'); ?></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Wybór tabeli</h3></td>
    </tr>
    <tr>
        <?php
        $options = array();
        foreach ($tables as $table)
        {
            $options[$table->TABLE_NAME] = $table->TABLE_NAME;
        }

        if(isset($table_1, $table_2))
        {
            $tab_1 = array(
                'name'  => 'table_1',
                'value' => $table_1,
                'readonly' => 'true'
            );
            $tab_2 = array(
                'name'  => 'table_2',
                'value' => $table_2,
                'readonly' => 'true'
            );
            echo '<td><b>Tabela 1</b>'.form_input(array(
                    'name' => $tab_1['name'],
                    'value' => $tab_1['value'],
                    'class' => 'form-control',
                    'readonly' => 'true'
                )).'</td>';

            echo '<td><b>Tabela 2</b>'.form_input(array(
                    'name' => $tab_2['name'],
                    'value' => $tab_2['value'],
                    'class' => 'form-control',
                    'readonly' => 'true'
                )).'</td>';
        } else
        {
            echo '<td>'.form_dropdown(array(
                    'name' => 'table_name_1',
                    'class' => 'form-control'
                ), $options).'</td>';
            echo '<td>'.form_dropdown(array(
                    'name' => 'table_name_2',
                    'class' => 'form-control'
                ), $options).'</td>';
        }
        ?>
    </tr>
    <tr>
        <td colspan="2"><h3>Wybierz relacje</h3></td>
    </tr>
</table>
    <div class="row">
    <div class="col-sm-6">
    <table class="table table-bordered" id="dynamic_field">
        <tr>
            <?php
            $options = array();
            if(isset($cols))
            {
                foreach ($cols as $col)
                {
                    $options[$col->COLUMN_NAME] = $col->COLUMN_NAME;
                }

            }

            echo '<td>'.form_dropdown(array(
                    'name' => 'rel[]',
                    'class' => 'form-control'
                ), $options).'</td>';
            echo '<td>'.form_dropdown(array(
                    'name' => 'rel[]',
                    'class' => 'form-control'
                ), $options).'</td>';
            echo '<td><button type="button" name="add" id="add" class="btn btn-success">Dodaj relacje</button></td>';
            ?>
        </tr>
    </table>
    </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <table id="sortable" class="table table-hover col-sm-9">
                <th>Koljność kolumn w raporcie</th>
                <?php
                if(isset($cols))
                {
                    foreach($cols as $col)
                    {
                        echo '<tr id='.$col->COLUMN_NAME.'><td>'.$col->COLUMN_NAME.'</td></tr>';
                    }
                }
                ?>
            </table>
        </div>
    </div>


<?php
if(isset($table_1, $table_2))
{
    echo form_submit('submit', 'generujta');
    echo form_close();
}else{
    echo form_submit('submit', 'Pokaż kolumny');
    echo form_close();
}
?>
<?php include APPPATH .'views/admin/include/footer.php' ?>