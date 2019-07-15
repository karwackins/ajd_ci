<?php include APPPATH .'views/admin/include/header.php' ?>

<h3>Wynik zapytania</h3>
    <?php //TODO dorobic wyswietlenie kolumn w tabeli
    $i = 0;
    $count = count($report[0][0]);
    $report_info = $report[1];
    $err = 0;

    ?>

<table class="table" style="font-size: xx-small">
    <?php
         $cols = explode(',',$report_info->cols);
         $stan =0;
         foreach ($cols as $col)
         {
             echo '<th>'.$col.'</th>';
             if(in_array($stan, $stan_arr))
             {
                 echo '<th>STAN</th>';
             }
             $stan++;
         }
        foreach ($report[0] as $r)
            {
                $err++;
                $c = 0;
                echo'<tr>';
                for ($i=0; $i<$count; $i++ )
                {
                    //TODO dorobic pobranie z bazy ilosci pol do porownania
                    if($c<=$report_info->conf) {
                        echo '<td>' . $r[$c] . '</td><td>' . $r[$c + 1] . '</td>';
                        if  ($r[$c + 1] == ''){
                            echo '<td style="background-color: #995c50">BRAK</td>';
                        } elseif ($r[$c] != $r[$c + 1]) {
                            echo '<td style="background-color: #bb8844">BŁĄD</td>';
                        } else {
                            echo '<td style="background-color: #009926">OK</td>';
                        }
                        $c=$c+2;
                    }
                    if($i>$report_info->conf)
                    {
                        echo '<td>'.$r[$i].'</td>';
                    }
                }
                echo'</tr>';
            }
    ?>
</table>
<?php  echo $err; ?>

<?php include APPPATH .'views/admin/include/footer.php' ?>
