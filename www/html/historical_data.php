<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'history.php';


session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}




$db = get_db_connect();
$user = get_login_user($db);


if(is_admin($user) === false){
  $histories = get_history($db, $user['user_id']);
}else{
  $histories = get_admin_history($db);
}







include_once '../view/history_view.php';