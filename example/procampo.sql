

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` varchar(40) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(20) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payed` tinyint(1) NOT NULL,
  `users_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`,`products_id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_orders_users_idx` (`users_id`),
  KEY `fk_orders_products1_idx` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(150) COLLATE utf8_bin NOT NULL,
  `name_of_product` varchar(40) COLLATE utf8_bin NOT NULL,
  `ref_of_product` varchar(15) COLLATE utf8_bin NOT NULL,
  `price_of_product` float NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `category_of_product` varchar(30) COLLATE utf8_bin NOT NULL,
  `shipping` float NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stars` int(11) NOT NULL,
  `comments` varchar(100) COLLATE utf8_bin NOT NULL,
  `products_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `comment_in` date NOT NULL,
  PRIMARY KEY (`id`,`products_id`,`users_id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_reviews_products1_idx` (`products_id`),
  KEY `fk_reviews_users1_idx` (`users_id`),
  KEY `products_id` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(20) COLLATE utf8_bin NOT NULL,
  `full_name` varchar(60) COLLATE utf8_bin NOT NULL,
  `address` varchar(90) COLLATE utf8_bin NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `sinceregisted` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reviews_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
