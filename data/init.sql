CREATE DATABASE IF NOT EXISTS tpm;
USE tpm;

CREATE TABLE IF NOT EXISTS merchants (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    name TEXT NOT NULL,

    global_discount FLOAT(3, 3) DEFAULT NULL,

    shipping_country TINYTEXT NOT NULL /* Country Codes (ISO 3166 Alpha-3) */
);

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    upc INT(12) ZEROFILL DEFAULT NULL UNIQUE KEY,

    merchant_id INT NOT NULL,

    name TEXT NOT NULL,

    units_available INT NOT NULL DEFAULT 0,
    unit_weight FLOAT(3, 1),

    unit_price FLOAT(6, 2) NOT NULL,
    unit_discount FLOAT(3, 3) DEFAULT NULL,

    shipping_method_highest TINYINT UNSIGNED DEFAULT NULL,

    FOREIGN KEY (merchant_id) REFERENCES merchants(id)
);

CREATE TABLE IF NOT EXISTS shipping_methods (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    name TINYTEXT NOT NULL,

    unit_price_flat FLOAT(6, 2) NOT NULL,
    unit_price_rate FLOAT(6, 2)
);

CREATE TABLE IF NOT EXISTS accounts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(128) NOT NULL UNIQUE KEY,
    email VARCHAR(128) NOT NULL UNIQUE KEY,

    password VARCHAR(1024) NOT NULL,

    name_first VARCHAR(64),
    name_last VARCHAR(64),

    name_full VARCHAR(128) GENERATED ALWAYS AS (CONCAT(name_first, ' ', name_last)),

    addressing JSON, /* JSON Object with billing and shipping address(es) */

    merchant_account BOOLEAN DEFAULT 0, /* Whether or not this account is a merchant account */
    merchant_id INT UNSIGNED,

    FOREIGN KEY (merchant_id) REFERENCES merchants(id)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

    account_id INT UNSIGNED NOT NULL, 

    products_ordered JSON NOT NULL, /* JSON Object with products ordered */
    addressing JSON NOT NULL, /* JSON Object with billing and shipping address(es) */

    FOREIGN KEY (account_id) REFERENCES accounts(id)
);