create database exam;
use exam;
create table exam(
 id int PRIMARY KEY auto_increment,
 booklet varchar(255),
 subject varchar(255),
 exam_date date
);
create table question(
 id int PRIMARY KEY auto_increment,
 exam_id int,
 no int,
 question text,
 choicea text,
 choiceb text,
 choicec text,
 choiced text,
 answer varchar(5)
);
create table subject(
subject varchar(5),
exam varchar(255)
);
create table user(
id int PRIMARY KEY auto_increment,
firstname varchar(255),
lastname varchar(255),
username varchar(255),
password varchar(255)
);