
<div id="login" class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card bg-dark  rounded-sm mt-5">
                <div class="card-header">Add Topic</div>

                <div class="card-body">
                    <form method="post" action="" >
                        <div class="form-group">
                            <label for="topic" class="control-label">Topic</label>
                            <input type="text" name="topic" id="topic" placeholder="Topic name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tdesc" class="control-label">Topic Desc</label>
                            <textarea id="tdesc" name="tdesc" placeholder="about Topic" class="form-control"></textarea>
                        </div>

                        <button type="submit" name="addtopic" class="btn-sm btn-block   btn-success">Add Topic</button>

                    </form>
                </div>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="topic">Topics Added</div>
            <? while ($rowtopic=$categ->fetch_assoc()){ ?>
            <div class="card bg-dark  rounded-sm mt-5">
<div class="detail">
<? echo $rowtopic['name']?>
    <? if (isset($_SESSION['id'])){
        if($_SESSION['role']== 1){ ?>
            <div class="dropleft float-right ml-4">
                <a class="text-white" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-ellipsis-v"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="helpers/deletetopic.php?tid=<? echo $rowtopic['id'] ?>"
                       onclick="return confirm('Delete Topic')">Delete</a>

                </div>
            </div>
        <?php } } ?>
</div>
                <div>
                    <p class="truncate filter-text"><?php echo strip_tags($rowtopic['description']) ?></p>
                </div>
            </div>
            <? }?>
            <?php if ($total_no_of_pages>0){ ?>
                <div class="">

                    <div class="justify-content-center" style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                        <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <? include 'pagination.php'?>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            <?}?>
        </div>
    </div>
</div>



