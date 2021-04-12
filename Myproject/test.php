<?php include 'views/db.php';
$user = Validate_User('bake_exe@mail.ru','qwerty');
echo $user['email'];
?>