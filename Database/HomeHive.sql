CREATE TABLE `AdminLogin` (
  `admin_id` integer PRIMARY KEY,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) UNIQUE NOT NULL,
  `admin_email` varchar(255) UNIQUE NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `created_at` timestamp,
  `last_login` timestamp
);

CREATE TABLE `UserLogin` (
  `user_id` integer PRIMARY KEY,
  `user_name` varchar(255) NOT NULL,
  `user_username` varchar(255) UNIQUE NOT NULL,
  `user_email` varchar(255) UNIQUE NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp,
  `last_login` timestamp
);

CREATE TABLE `UserAddress` (
  `user_id` integer NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255),
  `postal_code` integer NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `mobile_number` varchar(255) UNIQUE NOT NULL
);

CREATE TABLE `ProductCategory` (
  `category_id` integer PRIMARY KEY,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL
);

CREATE TABLE `Product` (
  `product_id` integer PRIMARY KEY,
  `category_id` integer,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_features` varchar(255) NOT NULL,
  `product_image_url` varchar(255) NOT NULL
);

CREATE TABLE `ProductInventory` (
  `product_id` integer,
  `product_quantity` integer NOT NULL,
  `last_modified` timestamp
);

CREATE TABLE `Cart` (
  `cart_id` integer PRIMARY KEY,
  `user_id` integer,
  `payment_id` integer,
  `cart_code` integer UNIQUE NOT NULL,
  `cart_total` integer NOT NULL,
  `created_at` timestamp,
  `last_modified` timestamp
);

CREATE TABLE `CartItems` (
  `cart_id` integer NOT NULL,
  `item_id` integer NOT NULL,
  `quantity` integer NOT NULL,
  `created_at` timestamp
);

CREATE TABLE `Orders` (
  `order_id` integer PRIMARY KEY,
  `cart_id` integer NOT NULL,
  `user_id` integer NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `placed_at` timestamp
);

CREATE TABLE `Return` (
  `return_id` integer PRIMARY KEY,
  `order_id` integer NOT NULL,
  `user_id` integer NOT NULL,
  `upi_id` varchar(255) NOT NULL,
  `return_date` timestamp
);

CREATE TABLE `Payment` (
  `payment_id` integer PRIMARY KEY,
  `order_id` integer NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `amount` integer NOT NULL,
  `payment_time` timestamp
);

ALTER TABLE `UserAddress` ADD FOREIGN KEY (`user_id`) REFERENCES `UserLogin` (`user_id`);

ALTER TABLE `Product` ADD FOREIGN KEY (`category_id`) REFERENCES `ProductCategory` (`category_id`);

ALTER TABLE `ProductInventory` ADD FOREIGN KEY (`product_id`) REFERENCES `Product` (`product_id`);

ALTER TABLE `Cart` ADD FOREIGN KEY (`user_id`) REFERENCES `UserLogin` (`user_id`);

ALTER TABLE `Cart` ADD FOREIGN KEY (`payment_id`) REFERENCES `Payment` (`payment_id`);

ALTER TABLE `CartItems` ADD FOREIGN KEY (`cart_id`) REFERENCES `Cart` (`cart_id`);

ALTER TABLE `CartItems` ADD FOREIGN KEY (`item_id`) REFERENCES `Product` (`product_id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`cart_id`) REFERENCES `Cart` (`cart_id`);

ALTER TABLE `Orders` ADD FOREIGN KEY (`user_id`) REFERENCES `UserLogin` (`user_id`);

ALTER TABLE `Return` ADD FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`);

ALTER TABLE `Return` ADD FOREIGN KEY (`user_id`) REFERENCES `UserLogin` (`user_id`);

ALTER TABLE `Payment` ADD FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`);
