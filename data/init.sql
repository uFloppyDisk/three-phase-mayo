CREATE DATABASE IF NOT EXISTS tpm;
USE tpm;

CREATE TABLE IF NOT EXISTS merchants (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    name TEXT NOT NULL UNIQUE KEY,

    global_discount FLOAT(3, 3) DEFAULT NULL,

    shipping_country TINYTEXT(3) NOT NULL
)

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    upc INT(12) ZEROFILL DEFAULT NULL UNIQUE KEY,
    merchant_id INT NOT NULL,

    name TEXT NOT NULL,

    units_available INT NOT NULL DEFAULT 0,
    unit_weight FLOAT(3, 1) 

    unit_price FLOAT(6, 2) NOT NULL,
    unit_discount FLOAT(3, 3) DEFAULT NULL,

    shipping_method_highest TINYINT UNSIGNED DEFAULT NULL,

    FOREIGN KEY (merchant_id) REFERENCES merchants(id)
)

CREATE TABLE IF NOT EXISTS shipping_methods (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    name ENUM('Standard', 'Expedited', 'Express', 'International', 'International Expedited', 'International Express'),

    unit_price_flat FLOAT(6, 2) NOT NULL,
    unit_price_rate FLOAT(6, 2)
)

CREATE TABLE IF NOT EXISTS accounts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(128) NOT NULL UNIQUE KEY,
    email VARCHAR(128) NOT NULL UNIQUE KEY,

    password VARCHAR NOT NULL,

    name_first VARCHAR(64),
    name_last VARCHAR(64),

    name_full VARCHAR(129) GENERATED ALWAYS AS (CONCAT(name_first, ' ', name_last)),

    shipping_address1 VARCHAR(128),
    shipping_address2 VARCHAR(128),
    shipping_city VARCHAR(32),
    shipping_region VARCHAR(32),
    shipping_postal VARCHAR(20),
    shipping_country VARCHAR(32),

    merchant_account BOOLEAN DEFAULT 0,
    merchant_id INT UNSIGNED
)

CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    product_id INT UNSIGNED NOT NULL,
    purchaser_id INT UNSIGNED NOT NULL,

    products_ordered JSON NOT NULL,

    shipping_tracking VARCHAR,

    shipping_address1 VARCHAR(128),
    shipping_address2 VARCHAR(128),
    shipping_city VARCHAR(32),
    shipping_region VARCHAR(32),
    shipping_postal VARCHAR(20),
    shipping_country VARCHAR(32)
)