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
            <div class="searchbx bg-dark">


                        <p>Looking for something?</p>

                            <form method="get" action="" class="text-center">

                                <label>
                                    <input type="text" required name="search" class="form-control" placeholder="Search the community to find answers and inspiration">
                                </label>

                            </form>

                        </div>


            <? if (isset($_GET['search'])){
if (mysqli_num_rows($searchquery)>0){
                while($rowfeed=$searchquery->fetch_assoc()){?>


                    <div class="card bg-dark">
                        <div class="details">
                            <img alt="initials" src="<? echo getinitials($rowfeed['user_id'])?>" class=" avatarImage profilePic">

                            <h2 class="topic"><? echo getusername($rowfeed['user_id']) ?> <i class="fad fa-chevron-right"></i> <? echo getcategoryname(explode(",",$rowfeed['category_ids'])) ?></h2>


                        </div>

                        <small class="timeago" style="margin-top:-25px; margin-left:70px;display: block; text-overflow: ellipsis; max-width: 100%; overflow: hidden; white-space: nowrap;"><? echo  timeago($rowfeed['date_created']) ?></small>
                        <div class="wrapper">
                            <div class="title ml-5">
                                <? echo $rowfeed['title'] ?></div>

                            <div>
                                <p class="truncate filter-text"><?php echo strip_tags($rowfeed['content']) ?></p>
                            </div>
                        </div>
                    </div>


                <? }}else{?>

                <div class="searchbx bg-dark">

                    <h2 class="topic text-white">Your query does not match any of our data</h2>
                </div>
            <?}?>
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
            <?}}?>

    </main>
    <? include 'navs/footer.php' ?>
</div>


<? include 'styles/scripts.php';
include 'modals/askmodal.php'?>
</body>
</html>
