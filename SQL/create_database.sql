CREATE DATABASE movies_php;

USE movies_php;

 CREATE TABLE users(
 	id INT NOT NULL AUTO_INCREMENT
 	, name VARCHAR(100)
 	, lastname VARCHAR(100)
 	, email VARCHAR(200)
 	, password VARCHAR(200)
 	, image VARCHAR(200)
 	, token VARCHAR(200)
 	, bio TEXT
 	, PRIMARY KEY(id)
 );

CREATE TABLE movies(
	id INT NOT NULL AUTO_INCREMENT
	, title VARCHAR(100)
	, description TEXT
	, image VARCHAR(200)
	, trailer VARCHAR(150)
	, category VARCHAR(50)
	, length VARCHAR(50)
	, users_id INT
	, FOREIGN KEY(users_id) REFERENCES user(id)
	, PRIMARY KEY(id)
);


CREATE TABLE reviews(
	id INT NOT NULL AUTO_INCREMENT
	, rating INT
	, review TEXT
	, users_id INT
	, movies_id INT
	,  FOREIGN KEY(users_id) REFERENCES users(id)
	, FOREIGN KEY(movies_id) REFERENCES movies(id)
	, PRIMARY KEY(id)
);


