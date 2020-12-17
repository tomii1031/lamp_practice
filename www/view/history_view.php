<?php
  // クリックジャッキング対策
  header('X-FRAME-OPTIONS: DENY');
?>

<!DOCTYPE html>
  <html lang="ja">

    <head>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'index.css')); ?>">
        <title>購入履歴画面</title>
    </head>

<body>


<div class="container">
<table class="table table-hover">
    <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>合計金額</th>
            <th>購入日時</th>
            <th>詳細へ</th>
          </tr>
     </thead>
     <tbody>
        <?php foreach($histories as $history){ ?>
          <tr>
            <td><?php print(h($history['order_id'])); ?></td>
            <td><?php print(h(number_format($history['total_price']))); ?>円</td>
            <td><?php print(h($history['create_datetime'])); ?></td>
            <td>
            <form action ="detail.php" method="post">
            <input type="submit" value="詳細へ"></input>
            <input type="hidden" name= "order_id" value="<?php print h($history['order_id']); ?>"></input>
           </form>
          </tr>
        <?php } ?>
     </tbody>
</table> 
</div>

</body>
</html>