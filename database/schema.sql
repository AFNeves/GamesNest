-----------------------------------------
-- DROP AND CREATE SCHEMA
-----------------------------------------

DROP SCHEMA IF EXISTS lbaw24105 CASCADE;
CREATE SCHEMA IF NOT EXISTS lbaw24105;
SET search_path TO lbaw24105;

-----------------------------------------
-- DROP TABLES/TYPES TO AVOID ERRORS
-----------------------------------------

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS payment_methods CASCADE;
DROP TABLE IF EXISTS orders CASCADE;
DROP TABLE IF EXISTS transactions CASCADE;
DROP TABLE IF EXISTS promotions CASCADE;
DROP TABLE IF EXISTS discounts CASCADE;
DROP TABLE IF EXISTS products CASCADE;
DROP TABLE IF EXISTS product_keys CASCADE;
DROP TABLE IF EXISTS categories CASCADE;
DROP TABLE IF EXISTS product_in_category CASCADE;
DROP TABLE IF EXISTS shopping_cart CASCADE;
DROP TABLE IF EXISTS wishlist CASCADE;
DROP TABLE IF EXISTS reviews CASCADE;
DROP TABLE IF EXISTS notifications CASCADE;
DROP TABLE IF EXISTS users_notified CASCADE;

DROP TYPE IF EXISTS address CASCADE;
DROP TYPE IF EXISTS provider CASCADE;
DROP TYPE IF EXISTS product_type CASCADE;
DROP TYPE IF EXISTS region CASCADE;
DROP TYPE IF EXISTS status CASCADE;
DROP TYPE IF EXISTS platform CASCADE;

-----------------------------------------
-- CREATE TYPES
-----------------------------------------

CREATE TYPE address AS (
    address_line TEXT,
    district VARCHAR(255),
    city VARCHAR(255),
    postal_code VARCHAR(255),
    country VARCHAR(255),
    phone_number VARCHAR(255)
);

CREATE TYPE provider AS ENUM ('Card', 'PayPal', 'MBWay', 'Revolut');

CREATE TYPE product_type AS ENUM ('Game', 'DLC', 'Game Points', 'Subscription');

CREATE TYPE region AS ENUM('Global', 'Europe', 'North America', 'South America', 'Africa', 'Asia', 'Oceania');

CREATE TYPE status AS ENUM ('Completed', 'Rejected', 'Waiting Payment', 'Waiting Key', 'Waiting Delivery', 'Delivered');

CREATE TYPE platform AS ENUM ('Steam','Xbox Live', 'Ubisoft Connect', 'Origin', 'Nintendo', 'PSN', 'Epic Games', 'Rockstar Games Launcher', 'Windows Store');

-----------------------------------------
-- CREATE TABLES
-----------------------------------------

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL CONSTRAINT auth_username_uk UNIQUE,
    email VARCHAR(255) NOT NULL CONSTRAINT auth_email_uk UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_picture TEXT NOT NULL DEFAULT 'default.jpg',
    preferred_address address,
    is_admin BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT auth_username_length CHECK (LENGTH(username) >= 5 AND LENGTH(username) <= 20)
);

CREATE TABLE payment_methods (
    id SERIAL PRIMARY KEY,
    provider provider NOT NULL,
    details TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id SERIAL PRIMARY KEY,
    price DECIMAL(5,2) NOT NULL,
    status status NOT NULL DEFAULT 'Waiting Payment',
    order_date TIMESTAMP NOT NULL DEFAULT now(),
    deliver_date TIMESTAMP,
    billing_address address,
    user_id INT NOT NULL DEFAULT 1,
    CONSTRAINT order_price_ck CHECK (price > 0),
    CONSTRAINT order_delivery_date_ck CHECK (deliver_date > order_date),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET DEFAULT
);

CREATE TABLE transactions (
    id SERIAL PRIMARY KEY,
    date TIMESTAMP NOT NULL DEFAULT now(),
    amount DECIMAL(5,2) NOT NULL,
    provider provider NOT NULL,
    status status NOT NULL DEFAULT 'Completed',
    order_id INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

CREATE TABLE promotions (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL CONSTRAINT promotion_name_uk UNIQUE,
    description TEXT NOT NULL
);

CREATE TABLE discounts (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL CONSTRAINT discount_name_uk UNIQUE,
    percentage DECIMAL(3,2) NOT NULL,
    start_date TIMESTAMP NOT NULL DEFAULT now(),
    end_date TIMESTAMP NOT NULL,
    promotion_id INT,
    CONSTRAINT discount_dates_ck CHECK (end_date > start_date),
    CONSTRAINT discount_percent_ck CHECK (percentage > 0 AND percentage < 1),
    FOREIGN KEY (promotion_id) REFERENCES promotions(id) ON DELETE CASCADE
);

CREATE TABLE products (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL CONSTRAINT product_title_uk UNIQUE,
    description TEXT NOT NULL,
    images TEXT NOT NULL,
    type product_type NOT NULL,
    platform platform NOT NULL,
    region region NOT NULL,
    price DECIMAL(5,2) NOT NULL,
    rating DECIMAL(3,2),
    visibility BOOLEAN NOT NULL DEFAULT TRUE,
    discount_id INT,
    CONSTRAINT product_price_ck CHECK (price > 0),
    CONSTRAINT product_rating_ck CHECK (rating >= 0 AND rating <= 5),
    FOREIGN KEY (discount_id) REFERENCES discounts(id) ON DELETE SET NULL
);

CREATE TABLE product_keys (
    id SERIAL PRIMARY KEY,
    key VARCHAR(255) NOT NULL CONSTRAINT product_key_uk UNIQUE,
    order_id INT,
    product_id INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL CONSTRAINT category_name_uk UNIQUE,
    description TEXT NOT NULL
);

CREATE TABLE product_in_category (
    product_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (product_id, category_id),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE shopping_cart (
    quantity INT NOT NULL DEFAULT 1,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (user_id, product_id),
    CONSTRAINT shopping_cart_item_quantity_ck CHECK (quantity >= 1),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE wishlist (
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (user_id, product_id),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE reviews (
    id SERIAL PRIMARY KEY,
    text TEXT NOT NULL,
    rating DECIMAL(3,2) NOT NULL,
    review_date TIMESTAMP NOT NULL DEFAULT now(),
    product_id INT NOT NULL,
    user_id INT NOT NULL DEFAULT 1,
    CONSTRAINT review_duplicated_ck UNIQUE (product_id, user_id),
    CONSTRAINT review_rating_ck CHECK (rating >= 0 AND rating <= 5),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET DEFAULT
);

CREATE TABLE notifications (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL
);

CREATE TABLE users_notified (
    user_id INT NOT NULL,
    notification_id INT NOT NULL,
    PRIMARY KEY (user_id, notification_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (notification_id) REFERENCES notifications(id) ON DELETE CASCADE
);

-----------------------------------------
-- PERFORMANCE INDEXES
-----------------------------------------

CREATE INDEX orders_idx ON orders USING hash(user_id);

CREATE INDEX product_key_idx ON product_keys USING btree(order_id, product_id);

CREATE INDEX transaction_idx ON transactions USING hash(order_id);

-----------------------------------------
-- FULL-TEXT SEARCH INDEX
-----------------------------------------

ALTER TABLE products
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION product_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.title), 'A') ||
            setweight(to_tsvector('english', NEW.region), 'B') ||
            setweight(to_tsvector('english', NEW.platform), 'C') ||
            setweight(to_tsvector('english', NEW.description), 'D')
        );
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF (NEW.title <> OLD.title OR NEW.description <> OLD.description
            OR NEW.region <> OLD.region OR NEW.platform <> OLD.platform) THEN
            NEW.tsvectors = (
                setweight(to_tsvector('english', NEW.title), 'A') ||
                setweight(to_tsvector('english', NEW.region), 'B') ||
                setweight(to_tsvector('english', NEW.platform), 'C') ||
                setweight(to_tsvector('english', NEW.description), 'D')
            );
        END IF;
    END IF;
    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER product_search_update
    BEFORE INSERT OR UPDATE
    ON products
    FOR EACH ROW
EXECUTE PROCEDURE product_search_update();

CREATE INDEX product_search_idx ON products USING GIN(tsvectors);

-----------------------------------------
-- TRIGGERS
-----------------------------------------

-- TRIGGER01

CREATE OR REPLACE FUNCTION update_product_rating()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE products
    SET rating = (
        SELECT AVG(rating) FROM reviews WHERE product_id = NEW.product_id
    )
    WHERE id = NEW.product_id;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_update_product_rating
    AFTER INSERT OR UPDATE OR DELETE
    ON reviews
    FOR EACH ROW
EXECUTE FUNCTION update_product_rating();

-- TRIGGER02

CREATE OR REPLACE FUNCTION update_order_status()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.status = 'Completed' AND NEW.amount = (SELECT price FROM orders WHERE id = NEW.order_id) THEN
        UPDATE orders
        SET status = 'Waiting Delivery'
        WHERE id = NEW.order_id;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_update_order_status
    AFTER INSERT
    ON transactions
    FOR EACH ROW
EXECUTE FUNCTION update_order_status();

-- TRIGGER03

CREATE OR REPLACE FUNCTION ensure_cart_stock()
RETURNS TRIGGER AS $$
BEGIN
    IF (SELECT COUNT(*) FROM product_keys WHERE product_id = NEW.product_id AND order_id IS NULL) < NEW.quantity THEN
        RAISE EXCEPTION 'Not enough stock available for product ID %.', NEW.product_id;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_ensure_cart_stock
    BEFORE INSERT OR UPDATE
    ON shopping_cart
    FOR EACH ROW
EXECUTE FUNCTION ensure_cart_stock();

