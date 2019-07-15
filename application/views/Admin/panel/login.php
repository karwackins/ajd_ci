<?php echo validation_errors(); ?>
<?php echo form_open('http://cms.local/admin/cPanel/login'); ?>
<!--<table>-->
<!--    <tr>-->
<!--        <td>Email</td>-->
<!--        <td>--><?php //echo form_input('email'); ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Hasło</td>-->
<!--        <td>--><?php //echo form_input('password'); ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td></td>-->
<!--        <td>--><?php //echo form_submit('submit', 'Zaloguj'); ?><!--</td>-->
<!--    </tr>-->
<!--</table>-->
<form class="form-signin">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <?php echo form_input('email'); ?>
    <label for="inputPassword" class="sr-only">Password</label>
    <?php echo form_input('password'); ?>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <?php echo form_submit('submit', 'Zaloguj'); ?>
</form>

<?php echo form_close(); ?>

