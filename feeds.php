<?php
include 'config/config.php';
include 'helpers/newsfeedhelper.php';
include 'helpers/topicshelper.php'?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home</title>
       <? include 'styles/styles.php' ?>
    </head>
    <body class="sb-nav-fixed">
       <? include 'navs/sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                       <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class=" text-center col">
                        <h3 class="mt-2">Q&A Feeds</h3>
                    </div>

                </div>
                           <? if (mysqli_num_rows($topic)>0){

                    while($rowfeed=$topic->fetch_assoc()){?>


                           <div class="card bg-dark">
                               <div class="wrapper">
                               <div class="details">
<img alt="initials" src="<? echo getinitials($rowfeed['user_id'])?>" class=" avatarImage profilePic">

                                   <h2 class="text-capitalize topic"><? echo getusername($rowfeed['user_id']) ?> <i class="fad fa-chevron-right"></i> <? echo getcategoryname(explode(",",$rowfeed['category_ids'])) ?></h2>

                                   <?if (isset($_SESSION['id'])){if($_SESSION['id'] == $rowfeed['user_id'] || $_SESSION['role']== 1){ ?>
                                   <div class="dropright float-right ml-4">
                                       <a class="text-white"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <span class="fa fa-ellipsis-v"></span>
                                       </a>
                                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                     <a class="dropdown-item" onclick="return confirm('Delete QA')" href="helpers/deleteqahelper.php?qaid=<? echo $rowfeed['id'] ?>&&qauid=<? echo $rowfeed['user_id']?> ">Delete</a>
                                       </div>
                                   </div>
                                   <?php } } ?>


                               </div>

                               <small class="timeago" style="margin-top:-25px; margin-left:70px;display: block; text-overflow: ellipsis; max-width: 100%; overflow: hidden; white-space: nowrap;"><? echo  timeago($rowfeed['date_created']) ?></small>

                                   <div class="title ml-5">
                                       <? echo $rowfeed['title'] ?></div>

                                   <div>
                                       <p class="truncate filter-text"><?php echo strip_tags($rowfeed['content']) ?></p>
                                   </div>
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


                               <? }}
                               else{?>
                           <div id="firstpost" class="text-center">
                               <? if (!isset($_SESSION['id'])){?>
                                   <a href="login.php"  class="btn btn-outline-warning">Login to ask a Question</a>
                               <? }else{?>
                               <button data-toggle="modal" data-target="#ask"  class="btn btn-outline-warning"><i class="fad fa-feather-alt"></i> Be the first to ask a question</button>
                               <? } ?>
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
                           <?}?>
                </main>
               <? include 'navs/footer.php' ?>
            </div>

   <? include 'styles/scripts.php';
   include 'modals/askmodal.php'?>
    </body>
</html>
