<div class="modal-header">
    <h5 class="modal-title">Add a book</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div id="message"></div>
    <form id="form_add_book">
        <div id="form_add_book_inner">
            <div class="form-group row">
                <label for="input_title" class="col-sm-4 col-form-label">Title</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="input_title" name="input_title">
                </div>
            </div>
            <div class="form-group row">
                <label for="input_isbn" class="col-sm-4 col-form-label">ISBN</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="input_isbn" name="input_isbn">
                </div>
            </div>
            <div class="form-group row">
                <label for="input_author" class="col-sm-4 col-form-label">Author</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="input_author" name="input_author">
                </div>
            </div>
            <div class="form-group row">
                <label for="input_publisher" class="col-sm-4 col-form-label">Publisher</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="input_publisher" name="input_publisher">
                </div>
            </div>
            <div class="form-group row">
                <label for="input_year_published" class="col-sm-4 col-form-label">Year Published</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="input_year_published" name="input_year_published">
                </div>
            </div>
            <div class="form-group row">
                <label for="input_category" class="col-sm-4 col-form-label">Category</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="input_category" name="input_category">
                </div>
            </div>
            
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>

<script>
    $("#form_add_book").submit(function(e){
        e.preventDefault();
        var formAddBook = new FormData($(this)[0]);
        $.ajax({
            url: "<?=site_url('home/add_book')?>",
            data: formAddBook,
            dataType: "json",
            type: "post",
            async: false,
            success: function(data){
                if(data.response == "false") {
                    $('#message').html(data.message);
                } else {
                    $('#form_add_book_inner').hide();
                    $('#message').html(data.message);

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