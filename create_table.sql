CREATE DATABASE IF NOT EXISTS kadince_todo;
USE kadince_todo;
DROP TABLE IF EXISTS `todos_tbl`;
CREATE TABLE IF NOT EXISTS `todos_tbl` (
  `todo_id` int NOT NULL AUTO_INCREMENT,
  `todo_task` varchar(1000) NOT NULL,
  `todo_status` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Pending',
  `creation_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  PRIMARY KEY (`todo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;