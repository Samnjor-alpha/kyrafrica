<?php
include '../config/config.php';
include '../sessions/session.php';

if (isset($_SESSION)){
    $qaid=$_GET['tid'];

    if ($_SESSION['role']==1){


        $deleteqa="delete from categories where id=$qaid";
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
