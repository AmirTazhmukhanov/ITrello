<?php
include 'views/db.php';
session_start();
if(isset($_SESSION['user'])) {
    $user_arr=Get_All_Users();
}
error_reporting(0);

?>
<html>
<?php include 'layout/head.php';?>

<body>
<div class="container">
    <?php include 'layout/navbar.php';?>
    <div class="row mb-5">
        <div class="offset-1">
        <?php include 'layout/ban_message.php';?>
        </div>
        <?php if($_SESSION['user']['user_status']=='active'){?>
        <?php foreach ($user_arr as $user) {
            $card_arr = Get_All_User_Cards($user['id']);
            ?>
        <div class="media mt-5">
            <img src="user_images/<?php echo $user['surname'].$user['name'].".png"?>" class="align-self-start mr-3" alt="..."  style="border-radius: 50%; width: 100px;height: 100px">
            <div class="media-body">
                <h5 class="mt-0"><?php echo $user['name'] ?></h5>
                <p><?php echo $user['surname']?></p>
                <p><?php echo $user['email']?></p>
                <a href="user_data.php/?id=<?php echo $user['id']?>">Details</a>
                <div class="row">
                    <?php foreach ($card_arr as $card) {?>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $card['name']?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $card['text']?></h6>
                                <p class="card-text"><?php echo $card['added_date']?></p>
                                <a href="details.php/?card_id=<?php echo $card['id']?>" class="card-link">Details</a>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
            <form method="post" action="views/crud.php">
                <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                <button class="btn btn-danger" name="delete_user" data-toggle="modal" data-target="#exampleModal3">Delete</button>
            </form>
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you wanna delete this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form method="post" action="views/crud.php">
                                    <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                                    <button type="submit" class="btn btn-danger" name="delete_user">Yes, I want</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php if ($user['user_status']=='banned'){?>
                <form method="post" action="views/crud.php">
                    <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                    <button class="btn btn-primary ml-3" name="unban_user" type="submit" data-toggle="modal" data-target="#exampleModal1">Unban</button>
                </form>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you wanna unban this user?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form method="post" action="views/crud.php">
                                        <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                                        <button type="submit" class="btn btn-danger" name="unban_user">Yes, I want</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php } else {?>
            <form method="post" action="views/crud.php">
                <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                <button class="btn btn-warning ml-3" name="ban_user" type="submit" data-toggle="modal" data-target="#exampleModal2">Ban</button>
            </form>
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you wanna ban this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form method="post" action="views/crud.php">
                                    <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                                    <button type="submit" class="btn btn-danger" name="ban_user">Yes, I want</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }?>
        </div>
        <?php }?>
        <?php } ?>
    </div>
</div>
<?php include "layout/footer.php";?>
</body>
</html>
