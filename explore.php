<?php
include 'config/config.php';
include 'helpers/explorehelper.php';
include 'helpers/topicshelper.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="../assets/fap.png" rel="icon">
    <title>Explore</title>
    <? include 'styles/styles.php' ?>
</head>
<body class="sb-nav-fixed">
<? include 'navs/sidebar.php' ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class=" text-center col">
                    <h3 class="mt-1">Explore</h3>
                </div>

            </div>
            <div class="searchbx" style="background-color:#121212;">


                <p>Looking for something?</p>

                <form method="get" action="" class="text-center">

                    <div class="input-group input-group-lg">
                        <input type="text" required name="search" class="form-control" placeholder="Search the community to find answers and inspiration">
                    </div>

                </form>

            </div>


            <? if (isset($_GET['search'])){
            if (mysqli_num_rows($searchquery)>0){
                while($rowfeed=$searchquery->fetch_assoc()){?>


                    <div class="card" style="background-color:#121212;">
                        <div class="details">
                            <img alt="initials" src="<? echo getinitials($rowfeed['user_id'])?>" class=" avatarImage profilePic">

                            <h2 class="text-capitalize" style="transition: all 0.15s ease-out 0s;
    cursor: pointer;
    text-decoration: none;
    outline: none;
    color: #d3d3d3;
    font-size: 16px;
    font-weight: 800;
    line-height: 18px;
    display: block;
    text-overflow: ellipsis;
    max-width: 100%;
    overflow: hidden;
    white-space: nowrap;"><? echo getusername($rowfeed['user_id']) ?> <i class="fad fa-chevron-right"></i> <? echo getcategoryname(explode(",",$rowfeed['category_ids'])) ?></h2>


                        </div>

                        <small class="timeago" style="margin-top:-25px; margin-left:70px;display: block; text-overflow: ellipsis; max-width: 100%; overflow: hidden; white-space: nowrap;"><? echo  timeago($rowfeed['date_created']) ?></small>
                        <div class="wrapper">
                            <div class="ml-2 mt-2">
                                <h4 class="mimi"> <? echo $rowfeed['title'] ?></h4>
                                <p class="truncate filter-text mimipia"><?php echo strip_tags($rowfeed['content']) ?></p>
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


                <? }}else{?>

                <div class="searchbx">

                    <h2 class="topic text-white">Your query does not match any of our data</h2>
                </div>
            <?}?>
            <?php if ($total_no_of_pages>0){ ?>

            <div class="row">
                <div class="col-md-12">

                    <? include 'pagination.php'?>
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
        <?}}?>

    </main>
    <? include 'navs/footer.php' ?>
</div>


<? include 'styles/scripts.php';
include 'modals/askmodal.php'?>
</body>
</html>