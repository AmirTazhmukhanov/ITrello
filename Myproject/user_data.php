<?php
include 'views/db.php';
?>
<html>
<?php include 'layout/head.php';
$user = Get_User($_GET['id']);
?>

<body>
<div class="container">
    <?php include 'layout/navbar.php'?>
    <div class="row mt-3">
        <div class="offset-1">
        <?php include 'layout/ban_message.php';?>
        </div>
        <?php if($_SESSION['user']['user_status']=='active'){?>
        <div class=" col-6 offset-3">
            <form action="views/authentication_view.php" method="post">
                <input type="hidden" value="<?php echo $user['id']?>" name="id">
                <h1>Update Profile Data</h1>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" value="<?php  echo $user['email']?>" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <i class="fas fa-user-circle"></i>
                    <label for="exampleInputName1">Name</label>
                    <input type="text" value="<?php  echo $user['name']?>" class="form-control" name="name" id="exampleInputName1">
                </div>
                <div class="form-group">
                    <i class="fas fa-user-circle"></i>
                    <label for="exampleInputName1">Surname</label>
                    <input type="text" value="<?php  echo $user['surname']?>" class="form-control" name="surname" id="exampleInputSurname1">
                </div>
                <div class="form-group">
                    <i class="fas fa-image"></i>
                    <label  for="exampleInputName1">Photo</label>
                    <img class="float-right" src="../user_images/<?php echo $user['surname'].$user['name'].".png"?>" style="border-radius: 50%; width: 100px;height: 100px">
                </div>
                <div class="form-group">
                    <button class="btn btn-success mt-5" type="submit" name="submit_data">Update data</button>
                </div>
            </form>
            <form action="views/authentication_view.php" method="post">
                <input type="hidden" value="<?php echo $user['id']?>" name="id">
                <h1 class="mt-5">Update Password</h1>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <label for="exampleInputOldPassword1">Old password</label>
                    <input type="password" class="form-control" name="old_password" id="exampleInputOldPassword1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <label for="exampleInputPassword1">New password</label>
                    <input type="password" class="form-control" name="new_password" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <label for="exampleInputPassword1">Repeat new password</label>
                    <input type="password" class="form-control" name="new_password2" id="exampleInputPassword2">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="submit_password">Change password</button>
                    <!-- Button trigger modal -->


                    <!-- Modal -->

                    <button type="submit" class="btn btn-warning" name="ban_user">Ban</button>
                </div>
            </form>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                Delete
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you wanna delete this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form method="post" action="../views/crud.php">
                                <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                                <button type="submit" class="btn btn-danger" name="delete_user">Yes, I want</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>
</body>
</html>