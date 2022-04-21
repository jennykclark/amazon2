<?php

require_once(__DIR__.'../../globals.php');
// validate
if( ! isset($_POST['email']) ){ _res(400, ['info'=>'email required']); }
if( ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
    _res(400, ['info'=>'invalid email']);
}

// validate password
if( ! isset($_POST['password']) ){ _res(400, ['info'=>'password required']); }
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN){ _res(400, ['info'=>'password min '._PASSWORD_MIN_LEN.' characters']);}
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN){ _res(400, ['info'=>'password max '._PASSWORD_MAX_LEN.' characters']);}


try{
    $db = _db();
}catch(Exception $ex){
    _res(500, ['info'=>'system under maintainance', 'error'=>__LINE__]);
}


try{
    $q = $db->prepare('SELECT * FROM users WHERE email = :email');
    $q->bindValue(':email', $_POST['email']);
    $q->execute();
    $row = $q->fetch();
    
    if(!$row){ _res(400, ['info'=>'wrong credentaials', 'error'=>__LINE__]);}

   // session // cookies
    session_start();
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['user'] = $row;

    // success
    _res(200, ['info'=>'success login']);   

}catch(Exception $ex){
    _res(500, ['info' => 'system under maintainance', 'error'=>__LINE__]);
}


// See the password_hash() example to see where this came from.
$hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (password_verify($_POST['password'], $hash_password)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

