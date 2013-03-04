# WS2-SWS-FIDDLES-SILEX - 02 - Olleh

More routing showcasing [requirements](http://silex.sensiolabs.org/doc/usage.html#requirements), [default values](http://silex.sensiolabs.org/doc/usage.html#default-values), and [Route Variable Converters](http://silex.sensiolabs.org/doc/usage.html#route-variables-converters).

## Requirements

- [Composer](http://getcomposer.org/)
- PHP 5.4

## Installation

- Get the source and install the dependencies

		$ git clone https://github.com/bramus/ws2-sws-fiddles-silex.git
		$ cd ws2-sws-fiddles-silex/02.olleh
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