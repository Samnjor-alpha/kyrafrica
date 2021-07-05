<?php include 'helpers/loginhelper.php'?>
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
            Don't have an account?
            <a href="register.php" class="btn btn-success">Sign up</a>

        </div>
        <div id="login" class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card bg-dark  rounded-sm mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light">Login</h3></div>
                        <div class="card-body">
                            <div>
                                <?php if (!empty($msg)): ?>
                                    <div class="alert <? echo $msg_class?> alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong><? echo $msg ?></strong>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="small mb-1" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control py-4" required>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input class="form-control py-4" name="password" id="inputPassword" type="password"/>
                                </div>

                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                    <button type="submit" name="login" class="btn btn-block btn-warning">Login</button>
                                </div>
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
