-- if the table exists, delete it
DROP TABLE IF EXISTS users;

-- create a new table
CREATE TABLE users(
	username VARCHAR(100) PRIMARY KEY,
	password VARCHAR(100) NOT NULL,
	fullname VARCHAR(100),
	primaryemail VARCHAR(100)
);

-- Insert data into the users table
INSERT INTO users (username, password, fullname, primaryemail) VALUES ('amit', MD5('1234'), 'Amit Gaddi', 'gaddiat@mail.uc.edu');
INSERT INTO users (username, password, fullname, primaryemail) VALUES ('admin', MD5('1234'), 'Admin', 'admin@mail.uc.edu');
