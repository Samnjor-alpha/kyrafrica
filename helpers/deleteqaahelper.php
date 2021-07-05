<?php
include '../config/config.php';
include '../sessions/session.php';

if (isset($_SESSION)){
    $qaid=$_GET['qaid'];
    $qauid=$_GET['qauid'];
    if ($_SESSION['id']==$qauid || $_SESSION['role']==1){

        $deleteqa="delete from comments where id=$qaid and user_id='$qauid'";
        if (mysqli_query($conn,$deleteqa)){
            echo "<script>
alert('Deleted successfully');
window.location.href='javascript: history.go(-1)';
</script>";
        }else{
            echo "<script>
alert('An error occured');
window.location.href='javascript: history.go(-1)';
</script>";
        }
    }}
