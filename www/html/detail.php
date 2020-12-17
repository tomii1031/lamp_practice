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

$order_id = get_post('order_id');

//dd($order_id);

$details = get_detail($db, $order_id);


//dd($details);



include_once '../view/detail_view.php';