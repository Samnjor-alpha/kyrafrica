<?php include 'helpers/adminregisterhelper.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <? include 'styles/styles.php' ?>
</head>
<body class="sb-nav-fixed">

<div id="layoutSidenav_content">
    <main>
        <div class="mt-4 mr-5 text-right">
            Already  have an account?
            <a href="login.php" class="btn btn-success">Sign in</a>

        </div>
        <div id="login" class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div>
                        <?php if (!empty($msg)): ?>
                            <div class="alert <? echo $msg_class?> alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong><? echo $msg ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card bg-dark  rounded-sm mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light">Sign Up</h3></div>
                        <div class="card-body">
                            <form method="post" action="" >
                                <div class="form-group">
                                    <label for="username" class="control-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="cpassword" class="control-label">Confirm Password</label>
                                    <input type="password" id="cpassword" name="cpassword" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="role" class="control-label">Admin/Staff</label>
                                    <select id="role"  name="role" class="form-control" required>
                                        <option class="form-control" value="1">Admin</option>
                                        <option class="form-control" value="2">Staff</option>
                                    </select>
                                </div>
                                <button type="submit" name="register" class="btn-sm btn-block   btn-success">Sign up</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<? include 'styles/scripts.php' ?>
</body>
</html>
