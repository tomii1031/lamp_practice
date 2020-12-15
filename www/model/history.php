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
          
        





  


