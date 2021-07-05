<?php
include 'config/config.php';
session_start();
$msg = "";
$msg_class = "";
if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $msg = "complete fields!";
        $msg_class = "alert-danger";
    }
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "select * from users where username='$username'";
    $result = $conn->query($query);
    if ($result->num_rows < 1) {
        $msg = "Username account does not exist!!";
        $msg_class = " alert-danger";
    } else {
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (!password_verify($_POST['password'], $row['password'])) {
                $msg = "Cross-check your password!!";
                $msg_class = "alert-danger";
            }else  if (password_verify($_POST['password'], $row['password'])) {


                $_SESSION['id'] = $row['id'];// Password matches, so create the sessions
                $_SESSION['role'] = $row['type'];// Password matches, so create the sessions
                $_SESSION['name'] = $row['name'];// Password matches, so create the sessions

                header("location:feeds.php", true, 303);



            }else{
                $msg = "An error occured.!!";
                $msg_class = "alert-danger";
            }}}}