<?php
include 'views/db.php';
session_start();
if(isset($_SESSION['user'])) {
    $arr = Get_All_User_Cards($_SESSION['user']['id']);
}
error_reporting(1);

?>


<html>
<?php include 'layout/head.php';?>
<body>
<div class="container">
<?php include 'layout/navbar.php';?>
<?php if(isset($_SESSION['user'])){?>
    <?php if($_SESSION['user']['user_status']=='banned'){?>
    <div class="jumbotron-fluid mt-3" style="border-radius: 10px; background-color: whitesmoke">
        <div class="container">
            <h1 class="display-4">You have been banned from this site</h1>
            <p class="lead">Admin banned you for some reason</p>
        </div>
    </div>
        <?php } else{?>
    <script async type="text/javascript" src="https://userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/d37713038df5414ab25a40f63c2c3a2c89fcf1ac776744f59ca46de9b7f8526f.js"></script>
    <div class="row">
    <div class=" col-6 offset-3">
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title">New Card</h5>
            <form method="post" action="views/crud.php">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <input type="text" class="form-control" name="text" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="add_card">
                        Add card
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
    <div class="row">
        <?php
        foreach ($arr as $i){
        ?>
        <div class="col-4">
            <div class="card bg-light mb-3" style="max-width: 18rem; margin-top: 15px">

            <div class="card-body">
                    <h5 class="card-title"><?php echo $i['name']; ?></h5>
                    <p class="card-text"><?php echo $i['text']; ?></p>
                <a href="details.php/?card_id=<?php echo $i['id'] ;?>" class="btn btn-primary">Details</a>
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
                                Are you sure you wanna delete this card?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form method="post" action="views/crud.php">
                                    <input type="hidden" value="<?php echo $i['id']?>" name="card_id">
                                    <button type="submit" class="btn btn-danger" name="delete_card">Yes, I want</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <p><?php echo $i['added_date']; ?></p>
                </div>
            </div>
        </div>
            <?php
            }
            ?>
    </div>
<?php ?>
    <?php } } else{?>
    <div class="jumbotron jumbotron-fluid mt-3" style="border-radius: 10px">
        <div class="container">
            <h1 class="display-4">Welcome to ITrello</h1>
            <p class="lead">To see some posts please, log in or register</p>
        </div>
    </div>
    <?php }?>
</div>
<?php include 'layout/footer.php'?>
</body>
</html>
