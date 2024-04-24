create database crud_database;
use crud_database;

create table users(
	user_id bigint unsigned primary key auto_increment,
    name varchar(200) not null,
    username varchar(50) not null unique,
    password varchar(255) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);