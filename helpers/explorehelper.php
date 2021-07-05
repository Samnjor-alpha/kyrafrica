<?php
if (isset($_GET['search'])){
    $search=$_GET['search'];


    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;


        $total_records_per_page = 5;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";

        $result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM topics where title LIKE '%{$search}%' OR content LIKE '%{$search}%'");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1

        $searchquery= mysqli_query($conn, "SELECT * FROM topics where title LIKE '%{$search}%' OR content LIKE '%{$search}%'   order by date_created Desc LIMIT $offset, $total_records_per_page");
    }
}

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
