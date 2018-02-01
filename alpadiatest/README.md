# Videogames manager

The project is developed using the micro-framework SlimPHP.

## Install the Application
This project includes the source code and the composer.phar file (we will use it to start and configure our project). First of all, check if you have the correct version of the software dependencies using the command in the root folder:

php composer.phar update

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can also run this command.

	php composer.phar start

Run this command to run the test suite

	php composer.phar test

That's it! Now go build something cool.
