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

$token = get_post('token');

if(is_valid_csrf_token($token) === false){
  unset($_SESSION['csrf_token']);
  redirect_to(LOGIN_URL);
}

unset($_SESSION['csrf_token']);

$db = get_db_connect();
$user = get_login_user($db);




$carts = get_user_carts($db, $user['user_id']);



if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
} 

$total_price = sum_carts($carts);

$db->beginTransaction();

if(history_carts($db, $total_price, $user['user_id']) === false){
  set_error('購入履歴の登録に失敗しました');
  $db->rollBack();
  redirect_to(CART_URL);
}

$order_id = $db->lastInsertId();



if(history_detail($db, $carts, $order_id) === false){
  set_error('購入明細の登録に失敗しました');
  $db->rollBack();
  redirect_to(CART_URL);
} 

$db->commit();

$histories = get_history($db, $user['user_id']);





include_once '../view/finish_view.php';
