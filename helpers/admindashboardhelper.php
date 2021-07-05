<?php
$tags=mysqli_query($conn,"select count(*) as totaltags from categories");
$qa=mysqli_query($conn, "select count(*) as totalqa from topics");
$users=mysqli_query($conn,"select count(*) as totalusers from users");

$totaltopics=$tags->fetch_assoc();
$totalqa=$qa->fetch_assoc();
$totalusers=$users->fetch_assoc();

//$categ=mysqli_query($conn,"select * from categories");
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

$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM categories");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

$categ = mysqli_query($conn,"SELECT * FROM categories  order by date_updated Desc LIMIT $offset, $total_records_per_page");

if (isset($_POST['addtopic'])){
    $topic = filter_var(stripslashes($_POST['topic']), FILTER_SANITIZE_STRING);
    $topicdesc = filter_var(stripslashes($_POST['tdesc']), FILTER_SANITIZE_STRING);
    if (empty($topic)|| empty($topicdesc)){
        echo "<script>
alert('Fill All fields');

</script>";
    }else{

        $sql_u = "SELECT * FROM categories WHERE name='$topic'";

        $res_u = mysqli_query($conn, $sql_u);
        if (mysqli_num_rows($res_u)>0){
            echo "<script>
alert('Topic already added');

</script>";
    }else{
            if(empty($error)) {

                $sql = "insert into categories SET name='$topic',description='$topicdesc'";
                if (mysqli_query($conn, $sql)) {

                    echo "<script>
alert('Topic added successfully');
window.location.href='javascript: history.go(-1)';
</script>";
        }else{
                    echo "<script>
alert('An Error occured.Try again');

</script>";
                }


}}}}
