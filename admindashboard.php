<?php
include 'config/config.php';
include "sessions/adminsession.php";
include 'helpers/profilehelper.php';
include 'helpers/topicshelper.php';
include 'helpers/admindashboardhelper.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <? include 'styles/styles.php' ?>
</head>
<body class="sb-nav-fixed">
<? include 'navs/sidebar.php' ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div id="profile" class="details">
                <img alt="initials" src="<? echo getinitials($_SESSION['id'])?>" class=" avatarImage2 profilePic">
                <p class="text-capitalize text-warning profile-topic"><? echo getusername($_SESSION['id']) ?> </p>
            </div>

            <div id="header-section">
                <ul id="eventnav" class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#managetopics">Manage Topics</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#upprof">Account Settings</a>
                    </li>

                </ul>
            </div>

            <section class="blog-details-section section-padding">
                <div class="container">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="home">

                            <? include 'iframes/homedashboard.php'?>



                        </div>
                        <div class="tab-pane container fade"  id="managetopics">
                            <div class="row mt-mb-15">
                                <? include 'iframes/topics.php'?>

                            </div>
                        </div>

                        <div class="tab-pane container fade"  id="upprof">
                            <div class="row mt-mb-15">
                                <? include 'iframes/profile.php' ?>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

    </main>
    <? include 'navs/footer.php' ?>
</div>


<?
   include 'modals/askmodal.php';
   include 'styles/scripts.php';
   ?>
</body>
</html>
