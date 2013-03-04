# WS2-SWS-FIDDLES-SILEX - 04 - Tweets Organized

Organizes the controllers for our different routes in classes; it's all about the structure!

References/Inspiration:

- [http://silex.sensiolabs.org/doc/organizing_controllers.html](http://silex.sensiolabs.org/doc/organizing_controllers.html) (The basic idea)
- [https://igor.io/2012/11/09/scaling-silex.html](https://igor.io/2012/11/09/scaling-silex.html) (A practical implementation of the idea)
- [https://github.com/Mparaiso/Silex-Blog-App](https://github.com/Mparaiso/Silex-Blog-App) (Pass entires classes into routes)

## Requirements

- [Composer](http://getcomposer.org/)
- PHP 5.4

## Installation

- Get the source and install the dependencies

		$ git clone https://github.com/bramus/ws2-sws-fiddles-silex.git
		$ cd ws2-sws-fiddles-silex/04.tweets-organized
		$ composer install

## Running the project

### Using PHP 5.4

- Open a shell, navigate to the project root and run `php -S localhost:8080 -t web web/index.php` to start a PHP web server
- Open `http://localhost:8080/` in your browser

### Using your favorite webserver

- Create a virtualhost pointing to the web folder
- Make sure you've enabled rewriting
	- See [http://silex.sensiolabs.org/doc/web_servers.html](http://silex.sensiolabs.org/doc/web_servers.html) for more info
	- A `.htaccess` for use with Apache is already included