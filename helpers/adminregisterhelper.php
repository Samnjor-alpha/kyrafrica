<?
include 'config/config.php';
session_start();

$msg = "";
$msg_class = "";
//Register start
if (isset($_POST['register'])) {
//    $cpassword = stripslashes($_POST['cpassword']);
    $username = filter_var(stripslashes($_POST['username']), FILTER_SANITIZE_STRING);
    $name = filter_var(stripslashes($_POST['name']), FILTER_SANITIZE_STRING);
    $password=filter_var(stripslashes($_POST['password']),FILTER_SANITIZE_STRING);
    $cpassword = filter_var(stripslashes($_POST['cpassword']),FILTER_SANITIZE_STRING);
    $role=filter_var(stripslashes($_POST['role']),FILTER_SANITIZE_STRING);




    if (empty($_POST['username']) || empty($_POST['role'])||  empty($_POST['name']|| empty($_POST['password']))) {
        $msg = "All inputs are required";
        $msg_class=" alert-danger";
    } else{

        if(strlen($username) <4)
        {
            $msg = "username is too short";
            $msg_class = " alert-danger";
        }else {


            $sql_u = "SELECT * FROM users WHERE username='$username'";

            $res_u = mysqli_query($conn, $sql_u);
            if (mysqli_num_rows($res_u)>0){
                $msg = "Username is associated with an account";
                $msg_class = " alert-danger";

            } else{


                if(strlen(trim($password)) <6)
                {
                    $msg = "password too short";
                    $msg_class = " alert-danger";
                }else{
// check if passwords match
                    if ($password !== $cpassword) {
                        $msg = "The passwords do not match";
                        $msg_class = " alert-danger";
                    } elseif ($password == $cpassword) {

                        $hash = password_hash($password, PASSWORD_DEFAULT);

                        if(empty($error)) {

                            $sql = "INSERT INTO users SET username='$username',name='$name',type='$role',password='$hash'";
                            if (mysqli_query($conn, $sql)) {

                                $msg="Registered successfully!!";
                                $msg_class=" alert-success";


                            }else{
                                $msg = "There was an Error in the database";
                                $msg_class=" alert-danger";
                            }


                        }
                    }
                }


            }

        }
    }}