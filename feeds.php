<?php
include 'config/config.php';
include 'helpers/newsfeedhelper.php';
include 'helpers/topicshelper.php';


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="assets/fap.png" rel="icon">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Q/A</title>
       <? include 'styles/styles.php' ?>
    </head>
    <body class="sb-nav-fixed">
       <? include 'navs/sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                       <div class="container-fluid">
                <div class="row justify-content-center">

                        <h3 class="mt-2" style="color:#555555;">Q&A</h3>
                    </div>
                </div>
                    <div class="row justify-content-center">
                    <div class="col-lg-10 col-sm-12">
                           <? if (mysqli_num_rows($topic)>0) while($rowfeed=$topic->fetch_assoc()){?>


                                  <div class="card" style="background-color:#121212;">
                                      <div class="wrapper">
                                      <div class="details">
       <img alt="initials" src="<? echo getinitials($rowfeed['user_id'])?>" class=" avatarImage profilePic">

                                          <h5 class="text-capitalize" style="transition: all 0.15s ease-out 0s;
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
           white-space: nowrap;"> <? echo getusername($rowfeed['user_id']) ?>  <i class="fad fa-chevron-right"> </i> <? echo getcategoryname(explode(",",$rowfeed['category_ids'])) ?></h5>
                                          <?if (isset($_SESSION['id'])){if($_SESSION['id'] == $rowfeed['user_id'] || $_SESSION['role']== 1){ ?>
                                          <div class="dropright float-right ml-4">
                                              <a class="text-white"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="fa fa-ellipsis-v"></span>
                                              </a>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" onclick="return confirm('Delete QA')" href="helpers/deleteqahelper.php?qaid=<? echo $rowfeed['id'] ?>&&qauid=<? echo $rowfeed['user_id']?><? if (!empty($rowfeed['img'])){ ?>&&img=<? echo $rowfeed['img']?> <?}?>">Delete</a>
                                              </div>
                                          </div>
                                          <?php } } ?>


                                      </div>

                                      <small class="timeago" style="margin-top:-25px; margin-left:70px;display: block; text-overflow: ellipsis; max-width: 100%; overflow: hidden; white-space: nowrap;"><? echo  timeago($rowfeed['date_created']) ?></small>

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



                                      <? }
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

    
                                   <div class="row">
                                       <div class="col-md-12">
                                           <? include 'pagination.php'?>
                                       </div><!-- end col -->
                                   </div><!-- end row -->
                               </div>
                           <?}?>
                    </div>
                    </div>
                </main>
               <? include 'navs/footer.php' ?>
            </div>


   <?
   include 'modals/askmodal.php';
   include 'styles/scripts.php';
   ?>

    </body>
</html>
