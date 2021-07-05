<?php
if (isset($_GET['qaid'])){
    $qaid=$_GET['qaid'];

    $qasingle=mysqli_query($conn,"SELECT * FROM topics where id='$qaid'");
//$rowsingle=$qasingle->fetch_assoc();

    if (mysqli_num_rows($qasingle) <= 0) {
        header("location:feeds.php");
    }

    $qry = $conn->query("SELECT t.*,u.name FROM topics t inner join users u on u.id = t.user_id where t.id= ".$_GET['qaid']);
    foreach($qry->fetch_array() as $k => $val){
        $$k=$val;
    }
    $comments = $conn->query("SELECT c.*,u.name,u.username FROM comments c inner join users u on u.id = c.user_id where c.topic_id= ".$_GET['qaid']." order by unix_timestamp(c.date_created) desc");
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