# WS2-SWS-FIDDLES-SILEX - 11 - Session & Upload

Introduces the [SessionServiceProvider](http://silex.sensiolabs.org/doc/providers/session.html) which is cleverly hooked on an other module using a [http://silex.sensiolabs.org/doc/middlewares.html#id1](before route middleware)

Also elaborates a tad further on [FormServiceProvider](http://silex.sensiolabs.org/doc/providers/form.html) and [ValidatorServiceProvider](http://silex.sensiolabs.org/doc/providers/validator.html) using a log and a upload form. Both forms use a customized HTML output (see the templates).

## Requirements

- [Composer](http://getcomposer.org/)
- PHP 5.4

## Installation

- Get the source and install the dependencies

		$ git clone https://github.com/bramus/ws2-sws-fiddles-silex.git
		$ cd ws2-sws-fiddles-silex/11.session-upload
		$ composer install

## Running the project

You can log in with any username and password combination you like as long as
- the password is the reverse of the username
- the username is at least 5 characters in length

### Using PHP 5.4

- Open a shell, navigate to the project root and run `php -S localhost:8080 -t web web/index.php` to start a PHP web server
- Open `http://localhost:8080/` in your browser

### Using your favorite webserver

- Create a virtualhost pointing to the web folder
- Make sure you've enabled rewriting
	- See [http://silex.sensiolabs.org/doc/web_servers.html](http://silex.sensiolabs.org/doc/web_servers.html) for more info
	- A `.htaccess` for use with Apache is already included