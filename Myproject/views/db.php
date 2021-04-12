<?php
$server_name = 'localhost';
$user_name = 'root';
$password = '';
try {
    $connection = new PDO("mysql:host=$server_name;dbname=php_project",$user_name,$password);
    $connection -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $exception){

}
function Current_date_time(){
    return date('Y-m-d H:i:s');
}
function Create_User($name,$surname,$email,$password){
    global $connection;
    $query = $connection->prepare("INSERT INTO user (id,name,surname,email,password) VALUES (NULL ,:name,:surname,:email,:password)");
    $row = $query->execute(array('name'=>$name,'surname'=>$surname,'email'=>$email,'password'=>$password));
    return $row>0;
}
function Get_All_Users(){
    global $connection;
    $query = $connection->prepare("SELECT * FROM user");
    $query->execute();
    $results = $query->fetchAll();
    return $results;
}
if (isset($_POST['submit'])){
    Create_User($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['password']);
}
function Get_User($id){
    global $connection;
    $query = $connection->prepare("SELECT * FROM user WHERE id=:id");
    $query->execute(array('id'=>$id));
    $results = $query->fetch();
    return $results;
}
function Get_User_By_Email($email){
    global $connection;
    $query = $connection->prepare("SELECT * FROM user WHERE email=:email");
    $query->execute(array('email'=>$email));
    $results = $query->fetch();
    return $results;
}
function Add_Card($name,$text){
    global $connection;
    $query=$connection->prepare("INSERT INTO card(id, name, text, added_date) VALUES(NULL,:name, :text, :date)");
    $rows=$query->execute(array("name"=>$name, "text"=>$text,"date"=>Current_date_time()));
    return $rows>0;
}
function Add_To_User_Card(){
    $user_id = $_SESSION['user']['id'];
    $card_id = Get_Last_Card()['id'];
    global $connection;
    $query=$connection->prepare("INSERT INTO card_user(id, user_id, card_id) 
    VALUES(NULL,:user_id, :card_id)");
    $query->execute(array("user_id"=>$user_id, "card_id"=>$card_id));
    return true;
}
function Get_Last_Card(){
    global $connection;
    $query = $connection->prepare("SELECT * FROM card ORDER BY id DESC ");
    $query->execute();
    $results = $query->fetch();
    return $results;
}
function Get_All_Cards(){
    global $connection;
    $query = $connection->prepare("SELECT * FROM card");
//    $row = $query->execute(array('name'=>$name,'surname'=>$surname,'age'=>$age));
    $query->execute();
    $results = $query->fetchAll();
    return $results;
}
function Get_card($id){
    global $connection;
    $query = $connection->prepare("SELECT * FROM card WHERE id=:id");
    $query->execute(array('id'=>$id));
    $results = $query->fetch();
    return $results;
}
function Get_task($id){
    global $connection;
    $query = $connection->prepare("SELECT * FROM card_task WHERE id=:id");
    $query->execute(array('id'=>$id));
    $results = $query->fetch();
    return $results;
}
function Delete_Card($id){
    $card = Get_card($id);
    if (isset($card)){
        global $connection;
        $query = $connection->prepare("DELETE FROM card_user WHERE card_id=:id");
        $query->execute(array('id'=>$id));
        $query = $connection->prepare("DELETE FROM card_task WHERE card_id=:id");
        $query->execute(array('id'=>$id));
        $query = $connection->prepare("DELETE FROM card WHERE id=:id");
        $query->execute(array('id'=>$id));
        return $id;
    }
    else {
        return false;
    }
}
function Delete_Task($task_id){
    $task = Get_task($task_id);
    if (isset($task)){
        global $connection;
        $query = $connection->prepare("DELETE FROM card_task WHERE id=:task_id");
        $query->execute(array('task_id'=>$task_id));
        return true;
    }
    else {
        return false;
    }
}
function Edit_Card($id,$new_name,$new_text){
    $card = Get_card($id);
    if (isset($card)){
        global $connection;
        $query = $connection->prepare("UPDATE card SET name=:new_name,text=:new_text WHERE id=:id");
        $query->execute(array('new_name'=>$new_name,'new_text'=>$new_text,'id'=>$id));
    }
}
function Search_Card($name,$text){
    global $connection;
    $query = $connection->prepare("SELECT * FROM card WHERE name LIKE ? or text LIKE ?");
    $query->execute(array("%$name%","%$text%"));
    $res = $query->fetchAll();
    return $res;
}
function Add_Task($name,$card_id){
    global $connection;
    $query = $connection->prepare("INSERT INTO card_task (id,name,added_date,card_id) VALUES (NULL ,:name,:added_date,:card_id)");
    $row = $query->execute(array('name'=>$name,'added_date'=>current_date_time(),'card_id'=>$card_id));
    return $row>0;
}
function Get_All_Tasks_By_Id($id){
    global $connection;
    $query = $connection->prepare("SELECT * FROM card_task WHERE card_id=:id");
    $query->execute(array('id'=>$id));
    $results = $query->fetchAll();
    return $results;
}
function Edit_Card_Task($id,$new_text){
    $task = Get_task($id);
    if (isset($task)){
        global $connection;
        $query = $connection->prepare("UPDATE card_task SET name=:new_text WHERE id=:id");
        $query->execute(array('new_text'=>$new_text,'id'=>$id));
    }
}
function Validate_User($email,$password){
    global $connection;
    $query = $connection->prepare("SELECT * FROM user WHERE email=:email AND password=:password");
    $query->execute(array('email'=>$email,'password'=>$password));
    $results = $query->fetch();
    return $results;
}
function Change_Task_To_Done($id){
    global $connection;
    $query = $connection->prepare("UPDATE card_task SET done='true' WHERE id=:id");
    $query->execute(array('id'=>$id));
    return true;
}
function Change_Task_To_Not_Done($id){
    global $connection;
    $query = $connection->prepare("UPDATE card_task SET done='false' WHERE id=:id");
    $query->execute(array('id'=>$id));
    return false;
}
function Change_User_Data($id,$email,$name,$surname){
    global $connection;
    $query = $connection->prepare("UPDATE user SET email=:email, name=:name, surname=:surname WHERE id=:id");
    $query->execute(array('id'=>$id, 'email'=>$email, 'name'=>$name, 'surname'=>$surname));
    return true;
}
function Change_User_Password($id,$new_password2){
    global $connection;
    $query = $connection->prepare("UPDATE user SET password=:new_password2 WHERE id=:id");
    $query->execute(array('new_password2'=>$new_password2,'id'=>$id));
    return true;
}
function Get_All_User_Cards($id){
    global $connection;
    $query=$connection->prepare("SELECT c.id, c.name, c.text, c.added_date 
    FROM card c INNER JOIN card_user cu ON c.id = cu.card_id WHERE cu.user_id =:id");
    $query->execute(array("id"=>$id));
    $rows=$query->fetchAll();
    return $rows;
}
function Delete_User($id){
    $user = Get_User($id);
    if (isset($user)) {
        global $connection;
        $query = $connection->prepare("DELETE FROM user WHERE id=:id");
        $query->execute(array('id' => $id));
        $query = $connection->prepare("DELETE FROM card_user WHERE user_id=:id");
        $query->execute(array('id' => $id));
        return true;
    }
    else{
        return false;
    }
}
function Ban_User($user_id){
    $user = Get_User($user_id);
    if (isset($user)) {
        global $connection;
        $query = $connection->prepare("UPDATE user SET user_status='banned' WHERE id=:user_id");
        $query->execute(array('user_id'=>$user_id));
        return true;
    }
    else{
        return false;
    }
}
function Unban_User($user_id){
    $user = Get_User($user_id);
    if (isset($user)) {
        global $connection;
        $query = $connection->prepare("UPDATE user SET user_status='active' WHERE id=:user_id");
        $query->execute(array('user_id'=>$user_id));
        return true;
    }
    else{
        return false;
    }
}
?>