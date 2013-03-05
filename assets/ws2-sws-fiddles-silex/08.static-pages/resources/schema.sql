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

INSERT INTO users VALUES (1, 'Bramus', 'Van Damme', 'bramus.vandamme@kahosl.be', 'http://www.bram.us/', 'Vinkt, Belgium', '$1$ikr/pd3F$ioj.iteh09cuxcj/6LClx/');
INSERT INTO users VALUES (2, 'Davy', 'De Winne', 'davy.dewinne@kahosl.be', 'http://www.davydewinne.be/', 'Schellebelle, Belgium', '$1$Tmppgmf6$treNaN/WSBGJ3OuzrLOd.0');
INSERT INTO users VALUES (3, 'Kevin', 'Picalausa', 'kevin.picalausa@kahosl.be', NULL, 'Gent, Belgium', '$1$6s4sG.Ol$XNxeu/0kVxhkHQvNBHLpP0');

CREATE TABLE links (
	id INTEGER PRIMARY KEY,
	url VARCHAR(255),
	title VARCHAR(255),
	added_by INTEGER,
	added_on DATE
);

INSERT INTO links VALUES (1, 'http://www.ikdoeict.be/', 'Website Ikdoeict.be', 3, '2013-02-03');
INSERT INTO links VALUES (2, 'http://www.hubkaho.be/', 'Website HUB-KAHO', 3, '2013-02-03');
INSERT INTO links VALUES (3, 'http://bramus.github.com/ws1-sws-course-materials/', 'Lesmateriaal Webscripten 1', 1, '2013-02-04');
INSERT INTO links VALUES (4, 'http://bramus.github.com/ria-course-materials/', 'Lesmateriaal Web & Mobile', 1, '2013-02-04');
INSERT INTO links VALUES (5, 'http://leercentrum.ikdoeict.be/', 'Leercentrum Ikdoeict', 1, '2013-02-04');