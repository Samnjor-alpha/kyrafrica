<?php


if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM topics where id=".$_GET['id'])->fetch_array();
    foreach($qry as $k =>$v){
        $$k = $v;
    }
}

?>
<style>
    img{
        max-width:100%;
    }
</style>
<div class="modal fade" id="ask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ask you'll be answered</h5>

                <button type="button" class="text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ask" action="" enctype="multipart/form-data" method="post">

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title:'' ?>" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="category_ids" class="control-label">Topic</label>
                            <select name="category_ids[]" id="category_ids"  class="form-control" required>
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
                    <div id="blah" class="preview-area"></div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="control-label">Question</label>
                            <textarea id="question" name="content" class="form-control text-jqte" required><?php echo isset($content) ? $content : '' ?></textarea>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="uploadFile"><i class="fas fa-photo-video fa-2x"></i></label>
                            <input type="file"  name="uploadFile" id="uploadFile" style="display:none" accept=".jpg, .png, .mp4" />

                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-success" name="addt">Ask</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    var inputLocalFont = document.getElementById("uploadFile");
    inputLocalFont.addEventListener("change",previewImages,false);

    function previewImages(){
        var fileList = this.files;

        var anyWindow = window.URL || window.webkitURL;

        for(var i = 0; i < fileList.length; i++){
            var objectUrl = anyWindow.createObjectURL(fileList[i]);
            $('.preview-area').append('<img src="' + objectUrl + '" /><br/>');
            window.URL.revokeObjectURL(fileList[i]);
        }


    }

</script>