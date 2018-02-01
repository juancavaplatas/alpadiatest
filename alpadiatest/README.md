# Videogames manager

The project is developed using the micro-framework SlimPHP. The application allows to the user to consult, write and delete information from a SQL database through a RESTful API.



## Install the Application
This project includes the source code, the sql dump and the composer.phar file (we will use it to start and configure our project). First of all, check if you have the correct version of the software dependencies using the command in the root folder:
```
php composer.phar update
```
It is possible that you may need to give permissions to the logs folder. We are going to drop some lines here so add read/write permissions:
```
sudo chmod -R 755 logs/
```
The project has two development environments, local and test. Your local configuration is defined in the deploy/settings/local.php. Please, modify here your database access and execute the next command:
```
php composer.phar localSetup
```
If you don't want to configure the project in your Apache2/Nginx server, SlimPHP provides a built-in PHP server who can be started with the command:
```
php composer.phar start
```

## Endpoint specification
After the installation you should be able to try accessing to the API endpoints (We recommend using Postman for this purpose). Any other request to the API out of this endpoints will receive a 40x response.

GET /members
Get the list of all members

GET /members/{id}
Get a member data

GET /members/{id}/games
Get a member games collection

GET /games
Get the list of all games

GET /games/{id}
Get a game data

PATCH /members/{id}
Updates a member info

PATCH /games/{id}
Updates a game data

POST /members
Creates a new member

POST /members/{id}/games
Adds one or more games to the member collection

POST /games
Creates a new game

DELETE /members/{id}
Deletes a member

DELETE /members/{member_id}/games/{game_id}
Deletes a game from the member collection

DELETE /games/{id}
Deletes a game
