<?php
session_start();
session_destroy();
header("location:feeds.php");
