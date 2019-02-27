
-- 用户表
create table `user` (
  `id` int unsigned primary key auto_increment,
  `username` varchar(10) not null unique,
  `password` char(32) not null,
  `email` varchar(40) not null
)charset=utf8;
