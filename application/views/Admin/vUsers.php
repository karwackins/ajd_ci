<html>
<head>
    <title></title>
</head>
<body>
<h1></h1>

<h3>Lista użytkowników</h3>
<a href="create">Nowy użytkownik</a>

<table>
    <tr>
        <td>Id</td>
        <td>Nazwa</td>
        <td>e-mail</td>
        <td>Rola</td>
    </tr>

    <?php foreach ($users as $user):?>

        <?php echo '<tr>
                        <td>'. $user->id.'</td>
                        <td>'. $user->name.'</td>
                        <td>'. $user->email.'</td>
                        <td>'. $user->role.'</td>
                        <td>'.anchor('/admin/cUser/edit/'.$user->id,'Edytuj').'</td>
                        <td><a href="delete/'.$user->id.'">Usuń</a></td>
                    </tr>';?>

    <?php endforeach;?>
</table>

</body>
</html>