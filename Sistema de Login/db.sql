create database login;

use login;

create table tb_login(
id int not null auto_increment primary key,
first_name varchar(45),
last_name varchar(45),
email varchar(45),
senha varchar(45)
);
