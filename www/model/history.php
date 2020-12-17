<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';






function history_carts($db, $total_price, $user_id){
   $sql = "
   INSERT INTO
     purchase_history
     (
       total_price,
       user_id
     )
     VALUES(:total_price, :user_id);
     ";

   $params = array(':total_price' => $total_price, ':user_id' => $user_id);

   return execute_query($db, $sql, $params);
  }








  function history_detail($db,$carts, $order_id){


    foreach($carts as $cart){
   

    if(sql_detail($db, $cart['item_id'], $order_id, $cart['amount'], $cart['price']) === false){
      return false;
 
    }

    
    }

    return true;

  }



function sql_detail($db,$item_id, $order_id, $amount, $price){


  $sql = "
     INSERT INTO
     purchase_details
      (
        item_id,
        order_id,
        amount,
        price
      )
      VALUES(:item_id, :order_id, :amount, :price); 
      ";

      $params = array(':item_id' => $item_id, ':order_id' => $order_id, ':amount' => $amount, ':price' => $price);

      return execute_query($db, $sql, $params);

}


function get_history($db, $user_id){
    
  $sql = "
            SELECT
              order_id,
              total_price,
              create_datetime
            FROM
              purchase_history
            WHERE
              user_id = :user_id
            ORDER BY create_datetime DESC
           ";

           $params = array(':user_id' => $user_id);

           return fetch_all_query($db, $sql, $params);
}


function get_detail($db, $order_id){

    $sql = "
    SELECT
      items.item_id,
      items.name,
      purchase_details.order_id,
      purchase_details.price,
      purchase_details.amount,
      purchase_history.total_price,
      purchase_history.create_datetime
    FROM
      purchase_details
    JOIN
      items
    ON
      purchase_details.item_id = items.item_id
    JOIN
      purchase_history
    ON
      purchase_details.order_id = purchase_history.order_id
    
    WHERE
      purchase_details.order_id = :order_id
  ";

  $params = array(':order_id' => $order_id);

  return fetch_all_query($db, $sql, $params);
}

function get_admin_history($db){

  $sql = "
            SELECT
              order_id,
              total_price,
              create_datetime
            FROM
              purchase_history
            ORDER BY create_datetime DESC
           ";


       return fetch_all_query($db, $sql);


}
          
        





  


