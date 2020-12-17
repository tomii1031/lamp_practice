<?php
  // クリックジャッキング対策
  header('X-FRAME-OPTIONS: DENY');
?>

<!DOCTYPE html>
  <html lang="ja">

    <head>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'index.css')); ?>">
        <title>購入詳細画面</title>
    </head>

<body>
<?php 
    include VIEW_PATH . 'templates/header_logined.php'; 
  ?>


<div class="container">
  <table class="table table-bordered">
      <thead class="thead-light">
            <tr>
              <th>注文番号</th>
              <th>合計金額</th>
              <th>購入日時</th>
            </tr>
      </thead>
      <tbody>
     
            <tr>
              <td><?php print(h($details[0]['order_id'])); ?></td>
              <td><?php print(h(number_format($details[0]['total_price']))); ?>円</td>
              <td><?php print(h($details[0]['create_datetime'])); ?></td>
            </tr>
      </tbody>
  </table>
</div>

<div class="container">
  <table class="table table-bordered">
      <thead class="thead-light">
            <tr>
              <th>商品名</th>
              <th>購入時の商品価格</th>
              <th>購入数</th>
              <th>小計</th>
            </tr>
      </thead>
      <tbody>
      <?php foreach($details as $detail){ ?>
        <?php  $subtotal = $detail['price'] * $detail['amount']; ?>
            <tr>
              <td><?php print(h($detail['name'])); ?></td>
              <td><?php print(h(number_format($detail['price']))); ?>円</td>
              <td><?php print(h($detail['amount'])); ?></td>
              <td><?php print(h($subtotal)); ?></td>
              
            </tr>
      </tbody>
      <?php } ?>
  </table>
</div>



</body>
</html>