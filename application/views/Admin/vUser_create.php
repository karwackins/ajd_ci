<?php echo validation_errors(); ?>
<?php echo form_open('http://cms.local/admin/cUser/create'); ?>

    <table>
        <tr>
            <td>Imię</td>
            <td><?php echo form_input('name'); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo form_input('email'); ?></td>
        </tr>
        <tr>
            <td>Hasło</td>
            <td><?php echo form_input('password'); ?></td>
        </tr>
        <tr>
            <td>Powtórz hasło</td>
            <td><?php echo form_input('passconf'); ?></td>
        </tr>
        <tr>
            <td>Role</td>

            <?php
                $options = array(
                    'admin' => 'admin',
                    'User' => 'User'
                )
            ?>

            <td><?php echo form_dropdown('role', $options, 'User'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit('submit', 'Dodaj użytkownika'); ?></td>
        </tr>
    </table>

<?php echo form_close(); ?>

