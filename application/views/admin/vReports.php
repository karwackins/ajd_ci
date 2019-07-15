<?php include APPPATH .'views/admin/include/header.php' ?>

<h3>Lista raportów AJD</h3>
<?php echo anchor('/admin/cReport/create/','Nowy raport AJD') ?>

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
            <td>'.anchor('/admin/cReport/test/'.$report->id,'test').'</td>
           </tr>';
    }
    ?>
    </tbody>
</table>

<?php include APPPATH .'views/admin/include/footer.php' ?>