<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';


function get_page(){

  if(false === isset($_GET['page'])){

    $page_num = 1;

  }else{

    $page_num = (int)$_GET['page'];

    if(1 > $page_num){

      $page_num = 1;
    }

    // dd($page_num);

  }

  return $page_num;

}



function get_count_table($db){
  $sql = "
  SELECT
    COUNT(*)id
  FROM
    items
  WHERE
   status = 1
";

return fetch_query($db, $sql);

}

function page_start($page_num){
  if($page_num > 1){
     $start = ($page_num * 3) -3;
  }else{
    $start = 0;
  }
  return $start;
}

function get_item_pagination($db, $start){
  $sql = "
  SELECT
    item_id, 
    name,
    stock,
    price,
    image,
    status
  FROM
    items
  WHERE
   status = 1
   LIMIT :start, 3
";

$params = array(':start' => $start);

return fetch_all_query($db, $sql, $params);

}

