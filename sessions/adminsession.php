<?php
session_start();

if ($_SESSION['role']!=1){
    header("location:feeds.php");
}
