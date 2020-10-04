<div class="modal-header">
    <h5 class="modal-title">Edit book</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div id="message_edit"></div>
    <form id="form_edit_book">
        <?php if($browsedBook):?>
            <div id="form_edit_book_inner">
                <div class="form-group row">
                    <label for="input_title" class="col-sm-4 col-form-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input_title" name="input_title" value="<?php echo $browsedBook['title']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_isbn" class="col-sm-4 col-form-label">ISBN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input_isbn" name="input_isbn" value="<?php echo $browsedBook['isbn']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_author" class="col-sm-4 col-form-label">Author</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input_author" name="input_author" value="<?php echo $browsedBook['author']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_publisher" class="col-sm-4 col-form-label">Publisher</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input_publisher" name="input_publisher" value="<?php echo $browsedBook['publisher']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_year_published" class="col-sm-4 col-form-label">Year Published</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input_year_published" name="input_year_published" value="<?php echo $browsedBook['year_published']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input_category" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input_category" name="input_category" value="<?php echo $browsedBook['category']?>">
                    </div>
                </div>

                <input type="hidden" class="form-control" id="hidden_id" name="hidden_id" value="<?php echo $browsedBook['id']?>">

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        <?php endif;?>
    </form>
</div>

<script>
    $("#form_edit_book").submit(function(e){
        e.preventDefault();
        var formEditBook = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('home/edit_book')?>",
            data: formEditBook,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data){
                if(data.response == "false") {
                    $('#message_edit').html(data.message);
                } else {
                    $('#form_edit_book_inner').hide();
                    $('#message_edit').html(data.message);

                    setTimeout(function(){
                        window.location.reload(1);
                    }, 800);
                }
            },
            contentType: false,
            cache: false,
            processData: false,
        });
    });
</script>