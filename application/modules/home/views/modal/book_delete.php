<div class="modal-header">
    <h5 class="modal-title">Delete book</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php if($browsedBook):?>
    <div class="modal-body">
        <div id="message_delete"></div>
        <div id="message_delete_div">
            <p>Are you sure you want to delete '<?php echo $browsedBook['title']?>' ?</p>
            <button id="btn_delelete_book" class="btn btn-success">Yes</button>
            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">No</button>
        </div>
    </div>
<?php endif;?>

<script>
    $(document).ready(function(){
        $('#btn_delelete_book').on('click', function(){
            $.ajax({
                url: "<?=site_url('home/delete_book')?>",
                data:{ bookID : '<?=$browsedBook['id'];?>'},
                type: "post",
                dataType: "json",
                success: function(data)
                {
                    if(data.response == "false") {
                        $('#message_delete').html(data.message);
                    } else {
                        $('#message_delete_div').hide();
                        $('#message_delete').html(data.message);

                        setTimeout(function(){
                            window.location.reload(1);
                        }, 800);
                    }
                }
            })
            return false;
        });
    })
</script>