use mysql;
create database kdhong_db;
insert into user (host, user, password)
values ('localhost', 'kdhong', password('1234'));
insert into db values('localhost', 'kdhong_db', 'kdhong', 
'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y'
);
flush privileges;