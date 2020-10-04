        <title><?= $title;?></title>

        <div class="row mb-3">
            <div class="col-12 col-md-4 col-lg-4">
                <div class="form-group">
                    <input type="email" class="form-control" id="input_search_keyword" name="input_search_keyword" placeholder="Enter your keywords">
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <button class="btn btn-info">Search</button>
            </div>
        </div>
            

        <div class="row mb-3">
            <div class="col-12 col-md-12 col-lg-12">
                <button class="btn btn-secondary">Recent</button>
                <button class="btn btn-dark">Archived</button>
                <button class="btn btn-success float-right" data-toggle="modal" data-target="#add_book">Add</button>
            </div>
        </div>


        <div class="row mb-3">
            <div class="table-responsive" id="div_searched_table" style="display: none;">
                <table class="table table-striped table-hover table-bordered" id="searched_table">
                    
                </table>
            </div>

            <div class="table-responsive" id="div_books_table">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>TITLE <div class="float-right"><a id="title_asc" href="">↑</a> <a id="title_desc" href="">↓</a></div></th>
                            <th>ISBN <div class="float-right"><a id="isbn_asc" href="">↑</a> <a id="isbn_desc" href="">↓</a></div></th>
                            <th>AUTHOR <div class="float-right"><a id="author_asc" href="">↑</a> <a id="author_desc" href="">↓</a></div></th>
                            <th>PUBLISHER <div class="float-right"><a id="pub_asc" href="">↑</a> <a id="pub_desc" href="">↓</a></div></th>
                            <th>YEAR PUBLISHED <div class="float-right"><a id="yearpub_asc" href="">↑</a> <a id="yearpub_desc" href="">↓</a></div></th>
                            <th>CATEGORY <div class="float-right"><a id="category_asc" href="">↑</a> <a id="category_desc" href="">↓</a></div></th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <?php if($books):?>
                        <tbody>
                            <?php foreach($books as $book):?>
                                <tr>
                                    <td><?=$book['title'];?></td>
                                    <td><?=$book['isbn'];?></td>
                                    <td><?=$book['author'];?></td>
                                    <td><?=$book['publisher'];?></td>
                                    <td><?=$book['year_published'];?></td>
                                    <td><?=$book['category'];?></td>
                                    <td>
                                        <button id="btn_edit<?=$book['id'];?>" class="btn btn-warning">Edit</button>
                                        <button id="btn_delete<?=$book['id'];?>" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                                <script>
                                    $(document).ready(function(){
                                        $('#btn_edit<?php echo $book['id']?>').on('click', function(){
                                            $.ajax({
                                                url: "<?=site_url('home/browse_book')?>",
                                                data:{ bookID : '<?=$book['id'];?>', bookAction : 'edit' },
                                                type: "post",
                                                success: function(data)
                                                {
                                                    $("#edit_book").modal('show');
                                                    $("#edit_book_inner").html(data);
                                                }
                                            })
                                            return false;
                                        });
                                    })

                                    $(document).ready(function(){
                                        $('#btn_delete<?php echo $book['id']?>').on('click', function(){
                                            $("#delete_book").modal('show');
                                            $.ajax({
                                                url: "<?=site_url('home/browse_book')?>",
                                                data:{ bookID : '<?=$book['id'];?>', bookAction : 'delete' },
                                                type: "post",
                                                success: function(data)
                                                {
                                                    $("#delete_book").modal('show');
                                                    $("#delete_book_inner").html(data);
                                                }
                                            })
                                            return false;
                                        });
                                    })
                                </script>
                            <?php endforeach;?>
                        </tbody>
                    <?php endif;?>
                </table>
                <?= $links; ?>
            </div>
        </div>

        <div class="modal" id="add_book">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?= $this->load->view('modal/book_details');?>
                </div>
            </div>
        </div>

        <div class="modal" id="edit_book">
            <div class="modal-dialog">
                <div class="modal-content" id="edit_book_inner">

                </div>
            </div>
        </div>

        <div class="modal" id="delete_book">
            <div class="modal-dialog">
                <div class="modal-content" id="delete_book_inner">

                </div>
            </div>
        </div>
        

        <script>
            $('#input_search_keyword').keyup(function(){
                if($('#input_search_keyword').val() == '' ){
                    $('#div_books_table').css('display', 'block');
                    $('#div_searched_table').css('display', 'none');
                } else {
                    $('#div_books_table').css('display', 'none');
                    $('#div_searched_table').css('display', 'block');
                    $.ajax({
                        url: "<?=site_url('home/search_book')?>",
                        data: {searchItem : $('#input_search_keyword').val()},
                        type: "post",
                        success: function(data){
                            if(data.response == "false") {
                            } else {
                                $("#searched_table").html(data);
                            }
                        },
                    })
                    return false;
                }
                
            })
            
        </script>