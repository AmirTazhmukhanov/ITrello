<?php
include 'views/db.php';
if(isset($_GET['card_id'])){
$id = $_GET['card_id'];
$tasks = Get_All_Tasks_By_Id($id);
$card = Get_card($id);
}
?>
<html>

<script type="text/javascript">
    function OpenForm(){
        var element = document.getElementById('edit_form_id')
        element.style.display = "block"
    }
    function CloseForm() {
        var element = document.getElementById('edit_form_id')
        element.style.display = "none"
    }
    function OpenTaskForm(){
        var element = document.getElementById('task_edit_id')
        element.style.display = "block"
    }
    function CloseTaskForm() {
        var element = document.getElementById('task_edit_id')
        element.style.display = "none"
    }
</script>
<?php include 'layout/head.php';?>
<body>
<div class="container">
    <?php include 'layout/details_navbar.php';?>
    <?php include 'layout/ban_message.php';?>
    <?php if($_SESSION['user']['user_status']=='active'){?>
    <div class="jumbotron mt-5" style="background-color: #5a6268">
        <h1 style="color: #ffffff">
    <?php echo $card['name'] ;?>
        </h1>
        <p style="color: #ffffff"><?php echo $card['text']; ?></p>
        <hr class="my-4" style="color: white">
        <p style="color: #ffffff"><?php echo $card['added_date'] ;?></p>
        <h3 id="edit_id" onclick="OpenForm()" style="color: white">+</h3>
        <h3 id="edit_id" onclick="CloseForm()" style="color: white">-</h3>

        <form style="display: none" method="post" action="../views/crud.php" id="edit_form_id">
            <input type="hidden" name="card_id" value="<?php echo $id;?>">
            <div class="form-group">
                <label style="color: white">Name </label>
                <input type="text" value="<?php echo $card['name']; ?>" name="name_edit">
                <label style="color: white;margin-top: 3px">Text</label>
                <input type="text" value="<?php echo $card['text'] ;?>" name="text_edit" >
                <button type="submit" name="edit_card" class="btn btn-success">Edit</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class=" col-6 offset-3">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">New Task</h5>
                    <form method="post" action="../views/crud.php" name="add_task">
                        <input type="hidden" name="card_id" value="<?php echo $id;?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="task_name" required placeholder="Type name of task...">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" name="add_card_task">
                                Add task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col">

        <?php foreach($tasks as $task){ ?>
            <div class="jumbotron mt-3 mb-5">
                <h1 class="display-4"><?php echo $task['name'];?></h1>
                <hr class="my-4" style="color: white">
                <p><?php echo $task['added_date'] ;?></p>
                <div class="row ml-2 mx-2">
                <h3 onclick="OpenTaskForm()">+</h3>
                <h3 onclick="CloseTaskForm()">-</h3>
                </div>
                <form action="../views/crud.php" method="post" id="task_edit_id" style="display: none">
                    <input type="hidden" value="<?php echo $id; ?>" name="card_id">


                    <input type="hidden" name="card_task_id" value="<?php echo $task['id'];?>">
                        <div class="form-group">
                            <label>Text</label>
                            <input type="text" value="<?php echo $task['name'] ;?>" name="task_name_edit" >
                            <button type="submit" name="edit_task" class="btn btn-success">Edit</button>
                        </div>
                    </form>
                <form action="../views/crud.php" method="post">
                    <input type="hidden" name="task_id" value="<?php echo $task['id']?>">
                    <input type="hidden" name="card_id" value="<?php echo $card['id']?>">
                    <?php if($task['done'] == "false"){?>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" onchange="this.form.submit()"  name="done" value="task_not_done" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Not Done</label>
                        </div>
                    <?php } else{?>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="done" checked="checked" onchange="this.form.submit()" value="task_done" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2">Done</label>
                        </div>
                    <?php }?>
                    <input type="hidden" value="<?php echo $task['id']?>" name="task_id">
                    <input type="hidden" value="<?php echo $card['id']?>" name="card_id">
                    <button class="btn btn-danger" name="delete_task">Delete</button>
                </form>
            </div>
        <?php }?>
    </div>
    </div>

</div>
<?php include "layout/footer.php";?>
</body>
<?php }?>
</html>
