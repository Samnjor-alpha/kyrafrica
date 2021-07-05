<?php
if (mysqli_num_rows($comments)>0){
    foreach($com_arr as $row):
        ?>
        <div class="card bg-dark">
            <div class="wrapper">
                <div class="details">
                    <img alt="initials" src="<? echo getinitials($row['user_id'])?>" class=" avatarImage profilePic">

                    <h6 class=""><a class="text-capitalize text-warning"><? echo getusername($row['user_id']) ?></a><i class="fad fa-chevron-right"></i> added an answer</h6>

                    <?if (isset($_SESSION['id'])){if($_SESSION['id'] == $row['user_id'] || $_SESSION['role']== 1){ ?>
                        <div class="dropright float-right ml-4">
                            <a class="text-white"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-ellipsis-v"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" onclick="return confirm('Delete QA')" href="helpers/deleteqaahelper.php?qaid=<? echo $row['id'] ?>&&qauid=<? echo $row['user_id']?> ">Delete</a>
                            </div>
                        </div>
                    <?php } } ?>



                </div>

                <small class="timeago" style="margin-top:-25px; margin-left:70px;display: block; text-overflow: ellipsis; max-width: 100%; overflow: hidden; white-space: nowrap;"><? echo  timeago($row['date_created']) ?></small>

                <div class="text-justify mt-1">
                    <p class="truncate filter-text"> <?php echo html_entity_decode($row['comment']) ?></p>
                </div>
                <br>



            </div>
        </div>
    <?php endforeach;?>

    <?php if ($total_no_of_pages>0){ ?>
        <div class="">

            <div class="justify-content-center" style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <? include 'comments-pagination.php'?>
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    <?}?>
<? }else{ ?>
    <div class="searchbx bg-dark">

        <h2 class="topic text-center text-white">This Question has not being answered yet</h2>
    </div>
<? }?>