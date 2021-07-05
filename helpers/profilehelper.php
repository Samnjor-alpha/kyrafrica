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

$result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM topics where user_id='".$_SESSION['id']."'");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

$topic = mysqli_query($conn, "SELECT * FROM topics where user_id='".$_SESSION['id']."'  order by date_created Desc LIMIT $offset, $total_records_per_page");
$profile=mysqli_query($conn,"select * from users where id='".$_SESSION['id']."'");
$rowprof=$profile->fetch_assoc();


if (isset($_POST['upprofile'])) {
//    $cpassword = stripslashes($_POST['cpassword']);
    $username = filter_var(stripslashes($_POST['username']), FILTER_SANITIZE_STRING);
    $name = filter_var(stripslashes($_POST['name']), FILTER_SANITIZE_STRING);


    if (empty($_POST['username']) || empty($_POST['name'])) {
        echo "<script>
alert('Fill All fields');

</script>";
    } else{

        if(strlen($username) <4)
        {
            echo "<script>
alert('Username is too short');

</script>";
        }else {


            $sql_u = "SELECT * FROM users WHERE username='$username' and not id='".$_SESSION['id']."'";

            $res_u = mysqli_query($conn, $sql_u);
            if (mysqli_num_rows($res_u)>0){
                echo "<script>
alert('Username name is associated with an account');

</script>";

            } else{



                        if(empty($error)) {

                            $sql = "UPDATE users SET username='$username',name='$name' where id='".$_SESSION['id']."'";
                            if (mysqli_query($conn, $sql)) {

                                echo "<script>
alert('Profile updated successfully');
window.location.href='javascript: history.go(-1)';
</script>";


                            }else{
                                echo "<script>
alert('An Error occured.Try again');

</script>";
                            }


                        }
                    }
                }


            }

        }

if (isset($_POST['uppwd'])){
if (empty($_POST['opwd'])|| empty($_POST['npwd'])|| empty($_POST['cnpwd'])){
    echo "<script>
alert('All fields required');

</script>";
}else {
    $oldpwd = filter_var(stripslashes($_POST['opwd']), FILTER_SANITIZE_STRING);
    $npwd = filter_var(stripslashes($_POST['npwd']), FILTER_SANITIZE_STRING);
    $cnpwd = filter_var(stripslashes($_POST['cnpwd']), FILTER_SANITIZE_STRING);

    $query = "select * from users where id='".$_SESSION['id']."'";
    $result = $conn->query($query);
    if ($result->num_rows < 1) {
        echo "<script>
alert('An error occurred.Login again');
</script>";

    } else {
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!password_verify($_POST['opwd'], $row['password'])) {
                echo "<script>
alert('Cross check your old password');

</script>";
            }else  if (password_verify($_POST['opwd'], $row['password'])) {
    if(strlen(trim($npwd)) <6)
    {
        echo "<script>
alert('Password is too short');

</script>";
    }else{
// check if passwords match
        if ($npwd !== $cnpwd) {
            echo "<script>
alert('New password do not match');

</script>";
        } elseif ($npwd == $cnpwd) {

            $hash = password_hash($npwd, PASSWORD_DEFAULT);

            if(empty($error)) {

                $sql = "UPDATE users SET password='$hash' where id='".$_SESSION['id']."'";
                if (mysqli_query($conn, $sql)) {

                    echo "<script>
alert('Password updated successfully');
window.location.href='javascript: history.go(-1)';
</script>";


                }else{
                    echo "<script>
alert('An Error occured.Try again');

</script>";
                }


            }
}   }
}
}}}}























function getinitials($id){
    global $conn;
    $name=mysqli_query($conn,"select username from users where id ='$id'");
    $fn=mysqli_fetch_assoc($name)['username'];
    $url="https://ui-avatars.com/api/";
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
