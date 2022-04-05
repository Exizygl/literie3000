create database literie;

use literie;

create table matelas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    marque VARCHAR(50),
    dimension VARCHAR(7),
    picture VARCHAR(256),
    prix DOUBLE(6,2),
    reduction DOUBLE(6,2)
);

