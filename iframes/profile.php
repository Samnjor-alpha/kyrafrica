
<div id="login" class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card bg-dark  rounded-sm mt-5">
                <div>
                    <?php if (!empty($msg)): ?>
                        <div class="alert <? echo $msg_class?> alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><? echo $msg ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <form method="post" action="" >
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" value="<? echo $rowprof['username']?>" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" value="<? echo $rowprof['name']?>" name="name" class="form-control" required>
                        </div>

                        <button type="submit" name="upprofile" class="btn-sm btn-block   btn-success">Update profile</button>

                    </form>
                </div>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="card bg-dark  rounded-sm mt-5">
                <p>Change password</p>
                <div class="card-body">
                    <form method="post" action="" >
                        <div class="form-group">
                            <label for="opwd" class="control-label">Old password</label>
                            <input type="password" id="opwd" name="opwd" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="npwd" class="control-label">New Password</label>
                            <input type="password" id="npwd"  name="npwd" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cnpwd" class="control-label">Confirm NewPassword</label>
                            <input type="password" id="cnpwd"  name="cnpwd" class="form-control" required>
                        </div>


                        <button type="submit" name="uppwd" class="btn-sm btn-block   btn-danger">Change Password</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>



