CREATE DATABASE pizza_hot;
USE pizza_hot;

CREATE TABLE user (
    id INT AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(30) NOT NULL,
    avatar_url VARCHAR(255),
    admin BOOLEAN DEFAULT 0,
    PRIMARY KEY (id)
)
;

CREATE TABLE product (
    id INT AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    subtitle VARCHAR(255) NOT NULL,
    price SMALLINT UNSIGNED NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)
;
