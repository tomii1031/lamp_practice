-- 注文番号(A.I,主キー) user_id 購入日時 total_price

-- 明細id (A.I,主キー) item_id, 注文番号,個数,購入した時の価格

CREATE TABLE purchase_history (
  `order_id` int NOT NULL AUTO_INCREMENT,
  --
  `user_id` int NOT NULL,
  `total_price` int NOT NULL,
  `create_datetime` datetime  DEFAULT CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`order_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;



CREATE TABLE purchase_details (
  `detail_id`  int NOT NULL AUTO_INCREMENT,
  --
  `item_id` int NOT NULL,
  `order_id` int NOT NULL,
  `amount` int NOT NULL,
  `price` int NOT NULL,
  --
  PRIMARY KEY (`detail_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
