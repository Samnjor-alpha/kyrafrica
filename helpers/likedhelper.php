<?php
$msg="";
$msg_class="";

if (!isset($_SESSION)){
session_start();
}
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
$page_no = $_GET['page_no'];
} else {
$page_no = 1;
}

$total_records_per_page = 5;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

$result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM likes where user_id='".$_SESSION['id']."'");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

//$likedtopic = mysqli_query($conn, "SELECT * FROM topics where user_id='".$_SESSION['id']."'  order by date_created Desc ");
$likedtopic=mysqli_query($conn, "SELECT * FROM likes	INNER JOIN topics ON topics.id = likes.postid 		WHERE   likes.user_id='".$_SESSION['id']."' order by likes.liked_at DESC LIMIT $offset, $total_records_per_page");
function count_total_post_like($post_id)
{
    global $conn;
    $query = mysqli_query($conn,"SELECT * FROM likes WHERE postid = '".$post_id."'");



    return mysqli_num_rows($query);
}
function outputmedia($id){
    global $conn;
    $medialink=mysqli_query($conn,"select  img from topics where id='$id'");
    $link=mysqli_fetch_assoc($medialink)['img'];

    $output='';
    $file_extension = strtolower(pathinfo($link, PATHINFO_EXTENSION));

    if($file_extension == 'jpg' || $file_extension == 'png')
    {
        $output='<img id="'.$id.'" alt="media" src="uploads/'.$link.'" class="img-responsive" /></p><br />';
    }elseif($file_extension == 'mp4')
    {
        $output='<div class="embed-responsive embed-responsive-16by9"><video class="embed-responsive-item" controls="controls" src="uploads/'.$link.'"></video></div>';


    }

    return $output;
}
function make_likeunlike_button($userid,$postid){

    global $conn;
    $results = mysqli_query($conn, "SELECT * FROM likes WHERE user_id='".$userid."' AND postid=".$postid."");
    $output='';
    if (mysqli_num_rows($results)>0 ){
        $output='<a  href="helpers/like.php?uid='.$userid.'&&postid='.$postid.'"><i class="unlike text-warning fad fa-thumbs-up"></i></a>';
    }else{
        $output='<a  href="helpers/like.php?uid='.$userid.'&&postid='.$postid.'"><i class="unlike fad fa-thumbs-up"></i></a>' ;
    }

    return $output;                                          // determine if user has already liked this post
}