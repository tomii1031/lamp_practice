<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'pagination.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);



//itemsテーブルから件数をとってくるsql
$item_num = get_count_table($db);


//dd($item_num['id']);

//総ページ数を計算するsql
$max_page = (int)ceil($item_num['id'] / 3);

//現在のページを取得する
$page_num = get_page();
//dd($page_num);


if($page_num > $max_page){
    $page_num = $max_page;
}

//取得したページ数に対して必要なitemの表示件数を取得する
$start = page_start($page_num);
//dd($start);

//$items = get_open_items($db, $start);

$items = get_item_pagination($db, $start);

if($page_num === $max_page){
  $item_fin = $item_num['id'];
}else{
  $item_fin = $start+3;
}





$token = get_csrf_token();

include_once VIEW_PATH . 'index_view.php';