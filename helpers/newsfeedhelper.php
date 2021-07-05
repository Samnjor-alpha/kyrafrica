<?php
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$total_records_per_page = 5;
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM topics");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

$topic = mysqli_query($conn,"SELECT * FROM topics  order by date_created Desc LIMIT $offset, $total_records_per_page");




function getinitials($id){
    global $conn;
    $name=mysqli_query($conn,"select name from users where id ='$id'");
    $fn=mysqli_fetch_assoc($name)['name'];
$url="https://ui-avatars.com/api/length=2";
    return $url.'?name='.$fn;

}

function getcategoryname($id){
    global $conn;
    foreach($id as $cat):
$categ=mysqli_query($conn,"select  name from categories where id='$cat'");
    endforeach;
    return mysqli_fetch_assoc($categ)['name'];
}
function getusername($id){
    global $conn;
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id =" . $id . " LIMIT 1");

    return mysqli_fetch_assoc($result)['username'];
}
function timeAgo($timestamp){

date_default_timezone_set("africa/nairobi");
    $time_ago        = strtotime($timestamp);
    $current_time    = time();
    $time_difference = $current_time - $time_ago;
    $seconds         = $time_difference;

    $minutes = round($seconds / 60); // value 60 is seconds
    $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
    $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
    $weeks   = round($seconds / 604800); // 7*24*60*60;
    $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
    $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

    if ($seconds <= 60){

        return "Just Now";

    } else if ($minutes <= 60){

        if ($minutes == 1){

            return "1 minute ago";

        } else {

            return "$minutes minutes ago";

        }

    } else if ($hours <= 24){

        if ($hours == 1){

            return "an hour ago";

        } else {

            return "$hours hrs ago";

        }

    } else if ($days <= 7){

        if ($days == 1){

            return "yesterday";

        } else {

            return "$days days ago";

        }

    } else if ($weeks <= 4.3){

        if ($weeks == 1){

            return "1 week ago";

        } else {

            return "$weeks weeks ago";

        }

    } else if ($months <= 12){

        if ($months == 1){

            return "a month ago";

        } else {

            return "$months months ago";

        }

    } else {

        if ($years == 1){

            return "1 year ago";

        } else {

            return "$years years ago";

        }
    }}

    if (isset($_GET['tid'])){
        $tid=$_GET['tid'];

        if (isset($_GET['topicpageno']) && $_GET['topicpageno']!="") {
            $page_no = $_GET['topicpageno'];
        } else {
            $page_no = 1;
        }

        $total_records_per_page = 5;
        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";

        $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM topics  where category_ids='$tid'");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1

        $tqas=mysqli_query($conn,"select * from topics where category_ids='$tid'  order by date_created Desc LIMIT $offset, $total_records_per_page");




        function gettopicname($id){

            global $conn;
            $topicname=mysqli_query($conn,"select name from categories where id='$id'");

            return mysqli_fetch_assoc($topicname)['name'];
        }

    }








    if (isset($_GET['qaid'])){
$qaid=$_GET['qaid'];

$qasingle=mysqli_query($conn,"SELECT * FROM topics where id='$qaid'");


if (mysqli_num_rows($qasingle) <= 0) {
    header("location:feeds.php");
}




        if (isset($_GET['comment_no']) && $_GET['comment_no']!="") {
            $page_no = $_GET['comment_no'];
        } else {
            $page_no = 1;
        }

        $total_records_per_page = 5;
        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";

        $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM comments where topic_id='".$_GET['qaid']."'");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1

        $comments = $conn->query("SELECT c.*,u.name,u.username FROM comments c inner join users u on u.id = c.user_id where c.topic_id= ".$_GET['qaid']." order by unix_timestamp(c.date_created) desc LIMIT $offset, $total_records_per_page");
        $qry = $conn->query("SELECT t.*,u.name FROM topics t inner join users u on u.id = t.user_id where t.id= ".$_GET['qaid']);
        foreach($qry->fetch_array() as $k => $val){
            $$k=$val;
        }

        $com_arr= array();
        while($row= $comments->fetch_assoc()){
            $com_arr[] = $row;
        }
        $replies = $conn->query("SELECT r.*,u.name,u.username FROM replies r inner join users u on u.id = r.user_id where r.comment_id in (SELECT id FROM comments where topic_id= ".$_GET['qaid'].") order by unix_timestamp(r.date_created) asc");
        $rep_arr= array();
        while($row= $replies->fetch_assoc()){
            $rep_arr[$row['comment_id']][] = $row;
        }
        if (isset($_SESSION['id'])){  $user_id =$_SESSION['id'];
            if($user_id != $_SESSION['id']){
                $chk = $conn->query("SELECT * FROM forum_views where  topic_id=$id and user_id='{$_SESSION['id']}' ")->num_rows;
                if($chk <= 0){
                    $conn->query("INSERT INTO forum_views set  topic_id=$id , user_id='{$_SESSION['id']}' ");
                }}
        }
        $view = $conn->query("SELECT * FROM forum_views where topic_id=$id")->num_rows;
        $tags = array();
        if(!empty($category_ids)){
            $tag = $conn->query("SELECT * FROM categories where id in ($category_ids) order by name asc");
            while($row= $tag->fetch_assoc()):
                $tags[$row['id']] = $row['name'];
            endwhile;
        }





    }