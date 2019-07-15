<?php echo validation_errors(); ?>
<?php echo form_open(); ?>

<table>
    <tr>
        <td>Imię</td>
        <td><?php echo form_input('name', $user->name); ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo form_input('email', $user->email); ?></td>
    </tr>
    <tr>
        <td>Hasło</td>
        <td><?php echo form_input('password'); ?></td>
    </tr>
    <tr>
        <td>Role</td>

        <?php
        $options = array(
            'admin' => 'admin',
            'user' => 'User'
        )
        ?>

        <td><?php echo form_dropdown('role', $options, $user->role); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Zapisz zmiany'); ?></td>
    </tr>
</table>

<?php echo form_close(); ?>

