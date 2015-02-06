DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS links;

CREATE TABLE users (
	id INTEGER PRIMARY KEY,
	firstname VARCHAR(255),
	lastname VARCHAR(255),
	email VARCHAR(255),
	url VARCHAR(255),
	location VARCHAR(255),
	password VARCHAR(255)
);

INSERT INTO users VALUES (1, 'Bramus', 'Van Damme', 'bramus.vandamme@odisee.be', 'http://www.bram.us/', 'Vinkt, Belgium', '$2y$10$XywEoP9Hi1PNLRNiDkDIiupfhIvcXVNUUxffy26Es6MBfFdZBia6S');
INSERT INTO users VALUES (2, 'Davy', 'De Winne', 'davy.dewinne@odisee.be', 'http://www.davydewinne.be/', 'Schellebelle, Belgium', '$2y$10$Sx/tY0TX4oLec0LdMs.qUOlrtz80A8AqL3vT.pfzdBAQzRXRtXORy');
INSERT INTO users VALUES (3, 'Kevin', 'Picalausa', 'kevin.picalausa@odisee.be', NULL, 'Gent, Belgium', '$2y$10$YuXGZ9//Aoe7eyBX4QeqP.j0ctrytlBo3fd8y4cCz7PCNMAcyOWby');

CREATE TABLE links (
	id INTEGER PRIMARY KEY,
	url VARCHAR(255),
	title VARCHAR(255),
	added_by INTEGER,
	added_on DATE
);

INSERT INTO links VALUES (1, 'http://www.ikdoeict.be/', 'Website Ikdoeict.be', 3, '2013-02-03');
INSERT INTO links VALUES (2, 'http://www.odisee.be/', 'Website Odisee', 3, '2013-02-03');
INSERT INTO links VALUES (3, 'http://bramus.github.com/ws1-sws-course-materials/', 'Lesmateriaal Webscripten 1', 1, '2013-02-04');
INSERT INTO links VALUES (4, 'http://bramus.github.com/ria-course-materials/', 'Lesmateriaal Web & Mobile', 1, '2013-02-04');
INSERT INTO links VALUES (5, 'http://leercentrum.ikdoeict.be/', 'Leercentrum Ikdoeict', 1, '2013-02-04');