<?php
include '../config/config.php';
if (!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['id'])){
  $userid=$_GET['uid'];
  $postid=$_GET['postid'];
  $checkifliked=mysqli_query($conn,"select * from likes where user_id='$userid' and postid='$postid'");
  if (mysqli_num_rows($checkifliked)<1){
   $like="INSERT INTO likes (user_id, postid) VALUES ($userid,$postid)";
   if (mysqli_query($conn,$like)){
       echo "<script>
 window.location.href='javascript: history.go(-1)';

</script>";
   }else{
       echo mysqli_error($conn);
   }
  }else{
     $unlike="DELETE FROM likes where user_id='$userid' and postid=$postid";
      if (mysqli_query($conn,$unlike)){
          echo "<script>
 window.location.href='javascript: history.go(-1)';

</script>";
      }else{
          echo mysqli_error($conn);
      }
  }

}else{
    echo"<script>
    alert('something terrible happened')
    </script>";
}