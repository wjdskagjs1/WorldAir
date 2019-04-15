create table product (
	num int not null auto_increment,
	name varchar(12) not null,
	price int,
	description text,
	thumbnail char(40),
	detail char(40),
	thumbnail_copied char(30),
	detail_copied char(30),
	primary key(num)
)ENGINE=MyISAM DEFAULT CHARSET=utf8; 
