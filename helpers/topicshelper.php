<?php

$sidetags=mysqli_query($conn,"select  * from categories");

$msg="";
$msg_class="";
if(!isset($_SESSION)){

    session_start();
}
if (isset($_POST['addt'])){
    if (!empty($_FILES)) {
        $file_extension = strtolower(pathinfo($_FILES["uploadFile"]["name"], PATHINFO_EXTENSION));



        $source_path = $_FILES["uploadFile"]['name'];

        $target_path = 'uploads/' . $_FILES["uploadFile"]["name"];




        $author=$_SESSION['id'];
        $title=filter_var(stripslashes($_POST['title']), FILTER_SANITIZE_STRING);
        $category=$_POST['category_ids'];
        $categoid=implode(",",$category);

        $content=filter_var(stripslashes($_POST['content']), FILTER_SANITIZE_STRING);

        if (empty($_POST['title']) || empty($_POST['content']|| empty($_POST['category_ids[]']))) {
            $msg = "inputs can not be empty";
            $msg_class=" alert-danger";
        } else{
            if(empty($error)) {
                if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target_path)) {
                    $sql = "INSERT INTO topics SET category_ids='$categoid',title='$title',img='$source_path',content='$content',user_id='$author'";
                    if (mysqli_query($conn, $sql)) {

                        echo "<script>
alert('Question submitted successfully');
window.location.href='feeds.php';
</script>";
                    }
                }else{
                    $msg = "There was an Error in the database";
                    $msg_class=" alert-danger";
                }


            }
        }
    }
    $author=$_SESSION['id'];
    $title=filter_var(stripslashes($_POST['title']), FILTER_SANITIZE_STRING);
    $category=$_POST['category_ids'];
    $categoid=implode(",",$category);

    $content=filter_var(stripslashes($_POST['content']), FILTER_SANITIZE_STRING);

    if (empty($_POST['title']) || empty($_POST['content']|| empty($_POST['category_ids[]']))) {
        $msg = "inputs can not be empty";
        $msg_class=" alert-danger";
    } else{
        if(empty($error)) {

            $sql = "INSERT INTO topics SET category_ids='$categoid',title='$title',content='$content',user_id='$author'";
            if (mysqli_query($conn, $sql)) {

                echo "<script>
alert('Question submitted successfully');
window.location.href='feeds.php';
</script>";



            }else{
                $msg = "There was an Error in the database";
                $msg_class=" alert-danger";
            }


        }
    }}


function counttopicsfromqa($id){

    global $conn;

    $countnotopics=mysqli_query($conn,"select count(*) as totaltopics from topics where category_ids='$id'");

    return mysqli_fetch_assoc($countnotopics)['totaltopics'];
}