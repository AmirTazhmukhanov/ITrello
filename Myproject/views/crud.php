<?php
include 'db.php';
session_start();
if(isset($_POST['add_card'])){
    $name = $_POST['name'];
    $text = $_POST['text'];
    Add_Card($name,$text);
    Add_To_User_Card($_SESSION['user']['id']);
    echo "<script>
                        window.location.href='../index.php';
                        alert('Card has been successfully added!');
                        </script>";
    exit;
}
else if(isset($_POST['delete_card'])){
    $id = $_POST['card_id'];
    Delete_Card($id);
    echo "<script>
                    window.location.href='../index.php';
                    alert('Card has been successfully deleted');
                    </script>
";
    exit();
}
else if(isset($_POST['done'])){
    $id = $_POST['task_id'];
    $card_id = $_POST['card_id'];
    if($_POST['done']=="task_done"){
        Change_Task_To_Not_Done($id);
    }
    else{
        Change_Task_To_Done($id);
    }
    echo "<script>
                    window.location.href='../details.php/?card_id='+$card_id;
                    alert('Great work!');
                    </script>
";
    exit();
}
else if(isset($_POST['edit_card'])){
    $id = $_POST['card_id'];
    $name = $_POST['name_edit'];
    $text = $_POST['text_edit'];
    Edit_Card($id,$name,$text);
    echo "<script>
                    window.location.href='../details.php/?card_id='+$id;
                    alert('Card has been successfully edited');
                    </script>
";
    exit();
}
else if(isset($_POST['edit_task'])){
    $task_id = $_POST['card_task_id'];
    $id = $_POST['card_id'];
    $name = $_POST['task_name_edit'];
    Edit_Card_Task($task_id,$name);
    echo "<script>
                    window.location.href='../details.php/?card_id='+$id;
                    alert('Card task has been successfully edited');
                    </script>
";
    exit();
}
else if(isset($_POST['to_search'])){
    $name = $_GET['name'];
    $text = $_GET['text'];
    Search_Card($name,$text);
    echo "<script>
                    window.location.href='../searched_cards.php';
                    </script>
";
    exit();
}
else if(isset($_POST['add_card_task'])){
    $id = $_POST['card_id'];
    $name = $_POST['task_name'];
    Add_Task($name,$id);
    echo "<script>
                    window.location.href='../details.php/?card_id='+$id;
                    alert('Task has been successfully added');
                    </script>
";
    exit();
}
else if(isset($_POST['delete_task'])){
    $task_id = $_POST['task_id'];
    $card_id = $_POST['card_id'];
    Delete_Task($task_id);
    echo "<script>
                    window.location.href='../details.php/?card_id='+$card_id;
                    alert('Task has been successfully deleted');
                    </script>
";
    exit();
}
else if(isset($_POST['delete_user'])){
    $user_id = $_POST['user_id'];
    Delete_User($user_id);
    echo "<script>
                    window.location.href='../admin_panel.php';
                    alert('You have been successfully deleted this user');
                    </script>
";
    exit();
}
else if(isset($_POST['ban_user'])){
    $user_id = $_POST['user_id'];
    Ban_User($user_id);
    echo "<script>
                    window.location.href='../admin_panel.php';
                    alert('You have been successfully banned this user');
                    </script>
";
    exit();
}
else if(isset($_POST['unban_user'])){
    $user_id = $_POST['user_id'];
    Unban_User($user_id);
    echo "<script>
                    window.location.href='../admin_panel.php';
                    alert('You have been successfully unbanned this user');
                    </script>
";
    exit();
}
else if(isset($_POST['banned_user'])){
    echo "<script>
                    window.location.href='../index.php';
                    alert('You have been banned from this site');
                    </script>
";
    exit();
}
?>
