

</div> <!-- /container -->

<footer class="footer">
    <div class="container">
        <p class="text-muted">v. 1.0</p>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src=src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"><\/script>')</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
    $( function() {
        $( "#sortable" ).sortable({
            update: function( event, ui ) {
                var order = $(this).sortable("toArray");

                $.ajax({
                        type: "POST",
                        url: "<?php echo 'http://ajd-ci.com/admin/cReport/ajax'; ?>",
                        data: { items: order },
                        success: function (msg)
                        {
                            $('input[name=cols]').val(msg);
                            $('#msg').html($('input').val());
                        }
                    }
                )
            },
            items: "tr",
            axis: "y"
        });
        $( "#sortable" ).disableSelection();
    } );

</script>

<script>
    $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append(`<tr id="row`+i+`"><td><?php echo form_dropdown('rel[]', $options) ?></td><td><?php echo form_dropdown('rel[]', $options) ?></td>
            <td><button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_remove">X</button></td></tr>`);
        });
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
        $('#submit').click(function(){
            $.ajax({
                url:"name.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function(data)
                {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });
    });
</script>
</body>
</html>