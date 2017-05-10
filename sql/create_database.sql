-- create the database and use it
CREATE DATABASE IF NOT EXISTS users;
USE users;

-- skapaar en avändare med lösenord pass
GRANT ALL ON users.* TO admin@localhost IDENTIFIED BY "test";
