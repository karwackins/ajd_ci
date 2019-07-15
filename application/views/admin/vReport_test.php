<?php include APPPATH .'views/admin/include/header.php' ?>
<h3>Test raportu</h3>

<table class="table">
    <thead>
    <th>id</th>
    <th>nazwa</th>
    <th>tabela 1</th>
    <th>tabela 2</th>
    <th>relacja</th>
    <th>kolumny</th>
    <th>ilosc kolumn<br>do porównania</th>
    </thead>
    <tbody>
    <tr>
        <?php
        $repInfo = $report['raportInfo'];
        $queryTest = $report['queryTest'];

            echo '<td>'.$repInfo->id.'</td>';
            echo '<td>'.$repInfo->name.'</td>';
            echo '<td>'.$repInfo->table_1.'</td>';
            echo '<td>'.$repInfo->table_2.'</td>';
//            echo '<td>'.$repInfo->col_1.' <=> '.$repInfo->col_2.'</td>';
            echo '<td></td>';
            echo '<td>'.$repInfo->conf.'</td>';
        ?>
    </tr>
    </tbody>
</table>
<div class="jumbotron">
    <?php echo $report['last_query']; ?>
</div>

<h3>Wynik zapytania</h3>
<table class="table">
    <?php
        $i = 0;
            echo '<tr>';
            foreach ($queryTest[0] as $key => $qt)
            {
                if($i <= ($repInfo->conf))
                {
                    if($i%2 == 0)
                    {
                        echo '<td>'.$key.'</td><td>'.$qt.'</td>';
                    }else
                    {
                        echo '<td>'.$key.'</td><td>'.$qt.'</td></tr>';
                    }

                    $i++;
                }
            }
    ?>
</table>

<?php include APPPATH .'views/admin/include/footer.php' ?>
