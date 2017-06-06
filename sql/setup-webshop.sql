SET NAMES utf8;

-- use users;

-- ------------------------------------------------------------------------
--
-- Setup tables
--
DROP TABLE IF EXISTS `Prod2Cat`;
DROP TABLE IF EXISTS `ProdCategory`;
DROP TABLE IF EXISTS `Inventory`;
DROP TABLE IF EXISTS `InvenShelf`;
DROP TABLE IF EXISTS `Cart`;
DROP TABLE IF EXISTS `Messeges`;
DROP TABLE IF EXISTS `Invoice`;
DROP TABLE IF EXISTS `cartOrder`;
DROP TABLE IF EXISTS `Product`;
DROP TABLE IF EXISTS `Customer`;


-- ------------------------------------------------------------------------
--
-- Product and product category
--
CREATE TABLE `ProdCategory` (
	`id` INT AUTO_INCREMENT,
	`category` CHAR(10),

	PRIMARY KEY (`id`)
);

CREATE TABLE `Product` (
	`id` INT AUTO_INCREMENT,
    `description` VARCHAR(20),
    `image` VARCHAR(100) DEFAULT NULL,
    `price` FLOAT DEFAULT NULL,
    `inventoryStatus` VARCHAR(20) DEFAULT "OutOfStock",
    `deleted` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`)
);

CREATE TABLE `Prod2Cat` (
	`id` INT AUTO_INCREMENT,
	`prod_id` INT,
	`cat_id` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`cat_id`) REFERENCES `ProdCategory` (`id`)
);


INSERT INTO `ProdCategory` (`category`) VALUES
("headwear"), ("t-shirts")
;

INSERT INTO `Product` (`description`, `image`, `price`) VALUES
("cap black", "cap_black.jpg", 40), ("T-shirt black", "tee_black.jpg", 50),
("beanie black", "beanie_black.jpg", 40), ("T-shirt blue", "tee_blue.jpg", 50) ,("beanie white", "beanie_white.jpg", 40)
;

INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES
(1, 1), (2, 2),
(3, 1), (4, 2),
(5, 1)
;
--

-- ------------------------------------------------------------------------
--
-- Inventory and shelfs
--
CREATE TABLE `InvenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

	PRIMARY KEY (`shelf`)
);

CREATE TABLE `Inventory` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT DEFAULT NULL,
    `shelf_id` CHAR(6) DEFAULT NULL,
    `items` INT DEFAULT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
	FOREIGN KEY (`shelf_id`) REFERENCES `InvenShelf` (`shelf`)
);

-- ----------------------------------------------------------------------------------------------------------------
-- Function for stock status.
--
DELIMITER //

DROP FUNCTION IF EXISTS stockStatus //
CREATE FUNCTION stockStatus(
	prod INTEGER
)
RETURNS CHAR(20)
BEGIN
	IF prod < 5 AND prod > 0 THEN
		RETURN "Low";
	ELSEIF prod > 0 THEN
		RETURN "InStock";
	END IF;
    RETURN "OutOfStock";
END
//
DELIMITER ;


DROP TRIGGER IF EXISTS ProdStatusStock;

CREATE TRIGGER ProdStatusStock
AFTER INSERT
ON Inventory FOR EACH ROW
	UPDATE Product SET
    inventoryStatus = stockStatus(NEW.items)
    WHERE
    id = NEW.prod_id;


DROP TRIGGER IF EXISTS ProdStatusUpdate;

CREATE TRIGGER ProdStatusUpdate
AFTER UPDATE
ON Inventory FOR EACH ROW
	UPDATE Product SET
    inventoryStatus = stockStatus(NEW.items)
    WHERE
    id = NEW.prod_id;
-- ------------------------------------------------------------------------

-- The truck has arrived, put the stuff into shelfs and update the database

INSERT INTO `InvenShelf` (`shelf`, `description`) VALUES
("AAA101", "House A, aisle A, part A, shelf 101"),
("AAA102", "House A, aisle A, part A, shelf 102")
;

INSERT INTO `Inventory` (`prod_id`, `shelf_id`, `items`) VALUES
(1, "AAA101", 10), (2, "AAA102", 10),
(3, "AAA101", 10), (4, "AAA102", 10),
(5, "AAA102", 10)
;


-- --------------------------------------------------------------------

CREATE TABLE `Customer` (
	`id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),

	PRIMARY KEY (`id`)
);
-- SELECT stockStatus(3) INTO @a;
-- SELECT @a;

CREATE TABLE Cart (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT DEFAULT NULL,
    `customer_id` INT DEFAULT NULL,
	`NumberOfItems` INT DEFAULT 1,


	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
);


INSERT INTO `Customer` (`firstName`, `lastName`) VALUES
("Ben", "Smith"),
("Steve", "Anderson"),
("Billy", "Kid")
;


DROP PROCEDURE IF EXISTS addToCart;

DELIMITER //

CREATE PROCEDURE addToCart(
	prod_id INT,
    cost_id INT,
	item_amount INT

)
BEGIN
	DECLARE prod_amount INT;
    DECLARE check_id INT;
    DECLARE check_del INT;

    START TRANSACTION;

	SET prod_amount = (SELECT items FROM Inventory WHERE id = prod_id );
    SET check_id = (SELECT id FROM Customer WHERE id = cost_id );
    SET check_del = (SELECT deleted FROM Product WHERE id = prod_id );

	IF prod_amount >= 0 AND check_id = cost_id AND (check_del IS NULL OR check_del > NOW()) THEN
		INSERT INTO `Cart` (`prod_id`, `customer_id`, `NumberOfItems`) VALUES
			(`prod_id`, `cost_id`, `item_amount`);

	ELSE
		ROLLBACK;
        SELECT "Somthing went wrong product not in stock / Invalid customer";

		COMMIT;

    END IF;

DROP VIEW IF EXISTS VCart;
CREATE VIEW VCart AS
SELECT
    C.id,
	Cos.firstName,
    P.description,
    P.price * C.NumberOfItems AS Price,
	C.NumberOfItems
FROM Cart AS C
	INNER JOIN Product AS P
		ON C.prod_id = P.id
	INNER JOIN Customer AS Cos
		ON C.customer_id = Cos.id
GROUP BY C.id
ORDER BY C.id
;
END

//
DELIMITER ;

-- ----------------------------------------------------------------------------
-- CALL addToCart(prod_id, cust_id, amount_of_items);

CALL addToCart(3, 1, 6);
CALL addToCart(2, 1, 21);
CALL addToCart(2, 2, 10);
CALL addToCart(1, 2, 3);
CALL addToCart(4, 2, 5);


DROP PROCEDURE IF EXISTS removeFromCart;
DELIMITER //

CREATE PROCEDURE removeFromCart(
	remove_id INT

)
BEGIN
	DECLARE getRemove_id INT;

    START TRANSACTION;

	SET getRemove_id = (SELECT id FROM Cart WHERE id = remove_id);
    -- SELECT getRemove_id;

	IF getRemove_id = remove_id THEN
		DELETE FROM Cart WHERE id = remove_id;

	ELSE
		ROLLBACK;
        SELECT "Somthing Went wrong item couldnt be removed";

		COMMIT;

    END IF;

DROP VIEW IF EXISTS VCart;
CREATE VIEW VCart AS
    SELECT
    C.id,
    P.description,
    P.price * C.NumberOfItems AS Price,
    Cos.firstName,
    C.NumberOfItems
FROM Cart AS C
	INNER JOIN Product AS P
		ON C.prod_id = P.id
	INNER JOIN Customer AS Cos
		ON C.customer_id = Cos.id
GROUP BY C.id
ORDER BY C.id
;
END
//
DELIMITER ;


-- CALL removeFromCart(3);
-- ----------------------------------------------------------------------------------------------



CREATE TABLE `cartOrder` (
	`id` INT AUTO_INCREMENT,
    `customer` INT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `product` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`),
    FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);


CREATE TABLE `Messeges` (
	`id` INT AUTO_INCREMENT,
	`product` INT,
    `OrderId` INT,
    `message` VARCHAR(20) DEFAULT NULL,
	`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`items` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);

-- CREATE INDEX index_message ON Messeges(message);

DELIMITER //

DROP FUNCTION IF EXISTS getNewAmount //
CREATE FUNCTION getNewAmount(
	oldAmount INTEGER,
	newAmount INTEGER,
	product_id INTEGER,
    order_ID INTEGER
)
RETURNS INTEGER
BEGIN
DECLARE toghter INTEGER;

	SET toghter = oldAmount - newAmount;

	IF toghter >= 0 AND toghter < 5 THEN
		INSERT INTO `Messeges` (`product`, `items`, `message`, `OrderId`) VALUES
			(`product_id`, `toghter`, "Low", `order_ID`);
		RETURN toghter;

    ELSEIF toghter >= 5 THEN
		RETURN toghter;

    ELSE
		INSERT INTO `Messeges` (`product`, `message`, `OrderId`) VALUES
			(`product_id`, "Order error", `order_ID`);
        RETURN oldAmount;

	END IF;
END
//
DELIMITER ;



DROP TRIGGER IF EXISTS OrderInventory;

CREATE TRIGGER OrderInventory
AFTER INSERT
ON cartOrder FOR EACH ROW
	UPDATE Inventory SET
		items = getNewAmount(items, New.items, prod_id, New.id)
	WHERE
		prod_id = New.product;


-- ------------------------------------------------------------------------------------

INSERT INTO `cartOrder` (`customer`, `product`, `items`)
SELECT `customer_id`, `prod_id`, `NumberOfItems` FROM `Cart`
;


DROP PROCEDURE IF EXISTS removeOrder;
DELIMITER //

CREATE PROCEDURE removeOrder(
	order_id INT

)
BEGIN
	DECLARE getRemove_id INT;
    DECLARE prod_idd INT;
	DECLARE items_amount INT;
	DECLARE items_amount2 INT;
	DECLARE toghter INT;
    DECLARE mes VARCHAR(100);

    START TRANSACTION;

	SET getRemove_id = (SELECT id FROM cartOrder WHERE id = order_id);
    SET prod_idd = (SELECT product FROM cartOrder WHERE id = order_id);
	SET items_amount = (SELECT items FROM Inventory WHERE prod_id = prod_idd);
	SET items_amount2 = (SELECT items FROM cartOrder WHERE id = order_id);
    SET mes = (SELECT message FROM Messeges WHERE OrderId = order_id);

	IF mes = "Order error" THEN
		DELETE FROM cartOrder WHERE id = order_id;
	ELSE
		UPDATE Inventory SET items = items_amount + items_amount2 WHERE prod_id = prod_idd;
        DELETE FROM cartOrder WHERE id = order_id;

		COMMIT;

    END IF;

END;
//
DELIMITER ;

-- CALL removeOrder(2);



SELECT * FROM Product;
SELECT * FROM Inventory;
SELECT * FROM VCart;

DROP VIEW IF EXISTS VOrder;
CREATE VIEW VOrder AS
SELECT
    Co.id AS id,
	P.description AS description,
    Co.customer AS customer,
	Cos.firstName AS firstName,
	Cos.lastName AS firstLastname,
    Co.items AS Items
FROM cartOrder AS Co
	INNER JOIN Product AS P
		ON Co.product = P.id
	INNER JOIN Customer AS Cos
		on Co.customer = Cos.id
GROUP BY Co.id
;

SELECT * FROM VOrder;
-- -------------------------------------------------------------------------


SELECT * FROM CART;
SELECT * FROM cartOrder;
SELECT * FROM Messeges;
