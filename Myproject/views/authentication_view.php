<?php
include "db.php";
session_start();
if(isset($_POST['register_submit'])){
    $name = $_POST['reg_name'];
    $surname = $_POST['reg_surname'];
    $email = $_POST['reg_email'];
    $password = $_POST['reg_password'];
    $full_name = $surname.$name;
    $file_name = $_FILES['image']['name'];
    rename($file_name,$full_name.".png");
    $file_tmp_name = $_FILES['image']['tmp_name'];
    $folder = "../user_images/";

    move_uploaded_file($file_tmp_name,$folder.$full_name.".png");
    $user = Get_User_By_Email($email);
    if($user != null){
        echo "<script>
                    window.location.href='../index.php';
                    alert('This email already exists');
                    </script>
";
    }
    else{
        Create_User($name,$surname,$email,$password);
        setcookie('user_email',$user['email'],time()+3600);
        setcookie('user_password',$user['password'],time()+3600);
        echo "<script>
                    window.location.href='../index.php';
                    alert('You have been successfully registered');
                    </script>
";
    }
}
else if(isset($_POST['login_submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = Validate_User($email,$password);
    if(isset($user)){
//        if($_POST['remember_me']=='checked'){
            $_SESSION['user'] = $user;
            setcookie('user_email',$user['email'],time()+360000);
            setcookie('user_password',$user['password'],time()+360000);
            setcookie('user_name',$user['name'],time()+360000);
//            echo "<script>
//                    window.location.href='../profile.php';
//                    alert('You have been successfully logged in');
//                    </script>
//"; exit;
//        }
//        else{
//            setcookie('user_email',$user['email'],time()+3600);
//            setcookie('user_password',$user['password'],time()+3600);
//            setcookie('user_name',$user['name'],time()+3600);
//            echo "<script>
//                    window.location.href='../profile.php';
//                    alert('You dont have accoujnt');
//                    </script>
//"; exit;
//        }
        echo "<script>
                    window.location.href='../profile.php';
                    alert('You have been successfully logged in');
                    </script>
"; exit;
    }
    else{
        echo "<script>
                    window.location.href='../index.php ';
                    alert('Incorrect password or email');
                    </script>
"; exit;
    }
}
else if(isset($_POST['log_out'])){
    session_destroy();
    echo "<script>
                    window.location.href='../index.php ';
                    alert('You have been successfully logged out');
                    </script>
"; exit;
}
else if(isset($_POST['submit_data'])){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    Change_User_Data($id,$email,$name,$surname);
    $_SESSION['user']['name']=$name;
    $_SESSION['user']['email']=$email;
    $_SESSION['user']['surname']=$surname;
        echo "<script>
                    window.location.href='../profile.php ';
                    alert('You have been successfully changed your profile data');
                    </script>
"; exit;
    }
else if(isset($_POST['submit_password'])){
    $id = $_POST['id'];
    $old_password = $_POST['old_password'];
    $new_password1 = $_POST['new_password'];
    $new_password2 = $_POST['new_password2'];
    if($old_password==$_SESSION['user']['password']){
        if($new_password2==$new_password1){
            Change_User_Password($id,$new_password1);
            $_SESSION['user']['password']=$new_password2;
            echo "<script>
                    window.location.href='../profile.php ';
                    alert('You have been successfully changed your password');
                    </script>
"; exit;
        }
        else{
            echo "<script>
                    window.location.href='../profile.php ';
                    alert('Passwords do not match');
                    </script>
"; exit;
        }
    }
    else{
        echo "<script>
                    window.location.href='../profile.php ';
                    alert('Passwords do not match');
                    </script>
"; exit;
    }
}
?>