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