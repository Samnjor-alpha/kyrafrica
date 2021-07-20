<h2 class="text-center">Liked Posts</h2>
<? if (mysqli_num_rows($likedtopic)>0){
    while($rowfeed=$likedtopic->fetch_assoc()){?>

        <div class="card bg-dark br">
            <div class="details">
                <img alt="initials" src="<? echo getinitials($rowfeed['user_id'])?>" class=" avatarImage profilePic">

                <h2 class="text-capitalize topic"><? echo getusername($rowfeed['user_id']) ?> <i class="fad fa-chevron-right"></i> <? echo getcategoryname(explode(",",$rowfeed['category_ids'])) ?></h2>


            </div>

            <small class="timeago" style="margin-top:-25px; margin-left:70px;display: block; text-overflow: ellipsis; max-width: 100%; overflow: hidden; white-space: nowrap;"><? echo  timeago($rowfeed['date_created']) ?></small>
            <div class="wrapper">
                <div class="title ml-5">
                    <? echo $rowfeed['title'] ?></div>

                <div>
                    <p class="truncate filter-text"><?php echo strip_tags($rowfeed['content']) ?></p>
                </div>
                <?if (!empty($rowfeed['img'])){ ?>
                    <div id="media">
                        <? echo outputmedia($rowfeed['id']) ?>
                    </div>
                <? }?>
                <?if (isset($_SESSION['id'])){?>
                    <? echo make_likeunlike_button($_SESSION['id'],$rowfeed['id']) ?>
                <?}?>
                <span class="likes_count"><? echo count_total_post_like($rowfeed['id']) ?> likes</span>



                <?
                $comment=mysqli_query($conn,"select count(*) as tcoments from comments where topic_id='".$rowfeed['id']."'");
                $totalcomments=$comment->fetch_assoc();
                ?>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a  href="view-QA.php?qaid=<? echo $rowfeed['id']?>" class="text-white"><? echo $totalcomments['tcoments']?> Answers</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>


    <? }}?>
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