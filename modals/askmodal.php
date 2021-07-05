<?php


if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM topics where id=".$_GET['id'])->fetch_array();
    foreach($qry as $k =>$v){
        $$k = $v;
    }
}

?>
<div class="modal fade" id="ask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ask you'll be answered</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title:'' ?>" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="category_ids" class="control-label">Topic</label>
                            <select name="category_ids[]" id="category_ids"  class="form-control custom-select" required>
                                <option value=""></option>
                                <?php
                                $tag = $conn->query("SELECT * FROM categories order by name asc");
                                while($row= $tag->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($category_ids) && in_array($row['id'], explode(",",$category_ids)) ? "selected" : '' ?>><?php echo $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="control-label">Question</label>
                            <textarea name="content" class="form-control text-jqte" required><?php echo isset($content) ? $content : '' ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-success" name="addt">Ask</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $('.select2').select2({
        placeholder:"Please select here",
        width:"100%"
    })
    $('.text-jqte').jqte();

</script>