create table member (
	userid    char(15) not null,
	password  char(15) not null,
	nickname  char(10) not null,
	email char(80) not null,
	regist_day char(20),
	point int,
	privilege boolean,
	ip char(15) not null,
	primary key(userid)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;