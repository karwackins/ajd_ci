<?php include APPPATH .'views/admin/include/header.php' ?>

<h3>Lista raportów AJD</h3>

<table class="table">
    <thead>
        <th>Id</th>
        <th>Nazwa</th>
    </thead>
    <tbody>
    <?php
    foreach ($reports as $report)
    {
     echo '<tr>
            <td>'.$report->id.'</td>
            <td>'.$report->name.'</td>
            <td>'.anchor('/cReport/generateReport/'.$report->id,'Generuj').'</td>
           </tr>';
    }
    ?>
    </tbody>
</table>

<?php include APPPATH .'views/admin/include/footer.php' ?>