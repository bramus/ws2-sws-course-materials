# WS2-SWS-FIDDLES-SILEX - 06 - Doctrine

Introduces the built-in [DoctrineServiceProvider](http://silex.sensiolabs.org/doc/providers/doctrine.html), allowing one to use [Doctrine's DBAL](http://www.doctrine-project.org/projects/dbal) within a Silex app.

## Requirements

- [Composer](http://getcomposer.org/)
- PHP 5.4
- SQLite

## Installation

- Get the source and install the dependencies

		$ git clone https://github.com/bramus/ws2-sws-fiddles-silex.git
		$ cd ws2-sws-fiddles-silex/06.doctrine
		$ composer install

- Create the database (in the project root)

		$ sqlite3 app.db < resources/schema.sql

## Running the project

### Using PHP 5.4

- Open a shell, navigate to the project root and run `php -S localhost:8080 -t web web/index.php` to start a PHP web server
- Open `http://localhost:8080/` in your browser

### Using your favorite webserver

- Create a virtualhost pointing to the web folder
- Make sure you've enabled rewriting
	- See [http://silex.sensiolabs.org/doc/web_servers.html](http://silex.sensiolabs.org/doc/web_servers.html) for more info
	- A `.htaccess` for use with Apache is already included