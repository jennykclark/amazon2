<?php 

require_once(__DIR__.'../../globals.php');
// Validate email
if( ! isset( $_POST['email'] ) ){ _res(400,['email is required']); }
if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ){ _res(400,['email is invalid']); }

//Validate password
if( ! isset( $_POST['password']) ){ _res(400,['password is required']); }
if( strlen( $_POST['password'] ) < _PASSWORD_MIN_LEN ){ _res(400,['password min'._PASSWORD_MIN_LEN.' characters']); }
if( strlen( $_POST['password'] ) > _PASSWORD_MAX_LEN ){ _res(400,['password max'._PASSWORD_MAX_LEN.' characters']); }


$db = require_once(__DIR__.'../../db.php');

try{

// $q = $db->prepare('SELECT * FROM users WHERE email = :email');
// $q->bindValue(':email', $_POST['email']);
// $q->execute();
// $row = $q->fetch();

// if(password_verify($_POST['currentPassword'], $row['password']) != $_POST['currentPassword']){
//     http_response_code(400);
//     // echo('correct password');
// }else{
//     // echo('wrong password');
// }

$q = $db->prepare("UPDATE users SET password = :password WHERE user_id = :user_id");
$q->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
$q->bindValue(':user_id', $_POST['user_id']);
$q->execute();

$response = ["User has been updated"];
 echo json_encode($response);

}catch(PDOException $ex){
http_response_code(500);
echo $ex;
exit();
}