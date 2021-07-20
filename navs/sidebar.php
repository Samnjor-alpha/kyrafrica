<?php
function active($currect_page){
    $url_array =  explode('/', $_SERVER['PHP_SELF']) ;
    $url = end($url_array);
    if($currect_page == $url){
        echo 'active'; //class name in css
    }
}

?>
<nav class="sb-topnav navbar navbar-expand d-sm-inline-block d-md-none d-lg-none d-xl-none ml-sm-0 ml-lg-0 ml-xl-0 ml-md-0">

      <button class="btn  d-sm-inline-block d-md-none d-lg-none d-xl-none ml-sm-0 ml-lg-0 ml-xl-0 ml-md-0 btn-link btn-sm order-1 order-lg-0" id="sidebarToggle"><i class="fas fa-bars" style="color:yellow;"></i></button>


        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">

                <nav class="sb-sidenav accordion" id="sidenavAccordion" style="background-color:#121212; font-size:15px;">
                    <div class="sb-sidenav-menu">
                        <img alt="KYR Africa" src="https://kyrafrica.com/assets/logo.png" class="image-fluid" height="50px">
                    </div>

                    <div class="sb-sidenav-menu">
                        <? if (isset($_SESSION['name'])){ ?>
                        <div class="sb-sidenav-menu-heading"><h5 class="ml-1 text-wrap text-capitalize text-white">Welcome, <? echo $_SESSION['name']?>.</h5></div>
                        <? } ?>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <? if(isset($_SESSION['role'])){
                                if($_SESSION['role']==1){?>
                                    <a class="nav-link" href="admindashboard.php">
                                        <div class="sb-nav-link-icon"><i class="fad fa-tasks"></i></div>
                                        Dashboard
                                    </a>
                                <? }} ?>
                            <a class="nav-link" href="feeds.php">
                                <div class="sb-nav-link-icon"><i class="fal fa-newspaper"></i></div>
                              Feeds
                            </a>
                            <a class="nav-link" href="explore.php">
                                <div class="sb-nav-link-icon"><i class="fal fa-compass"></i></div>
                                Explore
                            </a>
                            <? if (!isset($_SESSION['id'])){?>
                                <a class="nav-link" href="login.php">
                                    <div class="sb-nav-link-icon"><i class="fal fa-sign-in"></i></div>
                                    Login to ask a question
                                </a>
                            <? }else{?>
                                <a class="nav-link" data-toggle="modal" data-target="#ask">
                                    <div class="sb-nav-link-icon"><i class="fad fa-feather-alt"></i></div>
                                    Ask a question
                                </a>
                            <? }?>

                            <? if (isset($_SESSION['id'])){?>
                            <a class="nav-link" href="manageprofile.php">
                                <div class="sb-nav-link-icon"><i class="fal fa-user-circle"></i></div>
                                Profile
                            </a>
                            <? } ?>
                            <? if (mysqli_num_rows($sidetags)>0){ ?>
                            <div id="categ" class="sb-sidenav-menu-heading"><i class="text-warning fal fa-burn"></i> Popular Topics</div>
                            <? while($rowtags=$sidetags->fetch_assoc()){ ?>
                            <a class="nav-link" href="topic-QA.php?tid=<? echo $rowtags['id']?>">
                                <div class="sb-nav-link-icon"><i class="fad fa-folders"></i></div>
<? echo $rowtags['name'] ?> <span class="ml-1 badge badge-warning"><? echo counttopicsfromqa($rowtags['id'])?></span>
                            </a>
<?}?>
                        </div>
                        <? }?>
                    </div>

                    <div class="sb-sidenav-footer">
                        <? if (!isset($_SESSION['id'])){?>
<div class="text-left"><a class="btn btn-block btn-warning" href="login.php">Sign in</a> </div>
     <hr>
        <div class="text-left"style="margin-top:-15px;"><a href="register.php" class="btn btn-block btn-outline-warning">Join Forum</a> </div>
                        <? }else{?>
                        <div class="text-left ml-sm-auto "><a class="btn btn-block btn-outline-warning" href="logout.php">Log out</a> </div>
                        <? }?>
    </div>
    <br>
    <br>
                </nav>
            </div>