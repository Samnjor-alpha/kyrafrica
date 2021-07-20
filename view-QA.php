<?php
include 'config/config.php';
include 'helpers/newsfeedhelper.php';
include 'helpers/addcommenthelper.php';
include 'helpers/topicshelper.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Q/A</title>
              <link href="../assets/fap.png" rel="icon">

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
            <? if (mysqli_num_rows($qasingle)>0){

                while($rowfeed=$qasingle->fetch_assoc()){?>


                    <div class="card"style="background-color:#121212;">
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
    white-space: nowrap;"><? echo getusername($rowfeed['user_id']) ?> <i class="fad fa-chevron-right"></i> <? echo getcategoryname(explode(",",$rowfeed['category_ids'])) ?></h5>

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

                          <div class="ml-2 mt-2">
                                     <h4 class="mimi"> <? echo $rowfeed['title'] ?></h4> 
                                       <p class="truncate filter-text mimipia"><?php echo strip_tags($rowfeed['content']) ?></p>
                                   </div>
                            <?
                            $comment=mysqli_query($conn,"select count(*) as tcoments from comments where topic_id='".$rowfeed['id']."'");
                            $totalcomments=$comment->fetch_assoc();
                            ?>
                        </div>
                    </div>
                <? }}?>

                    <div class="col-lg-12 justify-content-center">
                        <div class="row justify-content-center ">
                            <h4><b> <i class="fa fa-comments"></i> Answers</b></h4>
                        </div>
                        <? if (isset($_SESSION['id'])){ ?>
                            <div>
                                <?php if (!empty($msg)): ?>
                                    <div class="alert <? echo $msg_class?> alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong><? echo $msg ?></strong>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="">
                                            <input type="hidden" name="topic_id" value="<?php echo isset($id) ? $id : '' ?>">
                                            <textarea class="form-control jqte" id="comment-txt" name="comment" cols="30" rows="5" placeholder="Add an answer" required></textarea>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="addcomment" class="btn btn-block btn-warning">Add Answer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <? } else {?>
                            <div class="text-center">
                    <span class="">
							<a href="login.php" class="btn btn-warning  btn-sm" >
					Login to add answer</a>
				</span>
                            </div>
                        <? } ?>

                       <? include 'comments.php' ?>

                    <hr class="divider" style="max-width: 100%">

                </div>

    </main>
    <? include 'navs/footer.php' ?>


<?
   include 'modals/askmodal.php';
   include 'styles/scripts.php';
   ?>
</body>
</html>
