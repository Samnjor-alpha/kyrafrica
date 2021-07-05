<?php
if(!isset($_SESSION)){

    session_start();
}
if (isset($_POST['addcomment'])){
    $topicid=$_POST['topic_id'];
    $comment=htmlentities(str_replace("'","&#x2019;",$_POST['comment']));
    $user_id=$_SESSION['id'];
    if (empty($_POST['comment']) || empty($_POST['topic_id']|| empty($user_id))) {
        echo "<script>
                alert('Field required');
                window.location.href='view-QA.php?qaid=$topicid';
                </script>";
    }else{
        if(empty($error)) {

            $sql = "INSERT INTO comments SET topic_id='$topicid',user_id='$user_id',comment='$comment'";
            if (mysqli_query($conn, $sql)) {

                echo "<script>
alert('Your answer was submitted successfully');
    
window.location.href='view-QA.php?qaid=$topicid';

</script>";




            }else{

                echo "<script>
                alert('An error occured');
                window.location.href='view-QA.php?qaid=$topicid';
                </script>";
            }


        }
    }
}