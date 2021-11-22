DROP DATABASE IF EXISTS todo;
CREATE DATABASE todo;
USE todo;

CREATE TABLE things(
    id INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    description varchar(50) NOT NULL,
    user varchar(50) NOT NULL,
    status BOOLEAN,
    num INTEGER
);

CREATE TABLE user(
    id INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE session(
    id INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    token varchar(200) NOT NULL,
    user varchar(50) NOT NULL
);

INSERT INTO user(username, password) VALUES
('test', '123');

INSERT INTO session(token, user) VALUES
('empty', 'empty');