# Videogames manager

The project is developed using the micro-framework SlimPHP. The application allows to the user to consult, write and delete information from a SQL database through a RESTful API.

The API accepts JSON and x-www-form-urlencoded requests, returning a JSON formatted response in both cases.  

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

| HTTP METHOD   | POST              | GET          | PATCH         | PUT         | DELETE          |
| ------------- | ----------------- | ------------ | ------------- | ----------- | --------------- |
| /members      | Create new member | List members | Not allowed   | Not allowed | Not allowed     |
| /members/{id} | Not allowed       | Get member   | Update member | Not allowed | Delete a member |
| /games        | Create new game   | List games   | Not allowed   | Not allowed | Not allowed     |
| /games/{id}   | Not allowed       | Get game     | Update game   | Not allowed | Delete a game   |
| /members/{id}/games | Adds one or more games to the member | Get member games collection   | Not allowed | Not allowed | Not allowed |
| /members/{id}/games/{game_id} | Not allowed | Not allowed | Not allowed | Not allowed | Deletes a game from the member collection |

## API examples

If you are using the default built-in PHP server, your API will be available on localhost:8080. Here you have some examples of each available endpoint

### GET members
Request:
- Type: GET
- URL: localhost:8080/members

Response (200):

    [
        {
            "id": 5,
            "name": "Bon",
            "surname": "Scott",
            "email": "bonscott@acdc.com",
            "created": "2018-02-01 20:33:12",
            "modified": "2018-02-01 20:33:12"
        },
        {...},
        {
            "id": 8,
            "name": "Axl",
            "surname": "Rose",
            "email": "axlrose@gunsnroses.com",
            "created": "2018-02-01 20:34:52",
            "modified": "2018-02-01 20:34:52"
        }
    ]

### GET members/id
Request
- Type: GET
- URL: localhost:8080/members/5

Response (200):

    {
        "id": 5,
        "name": "Bon",
        "surname": "Scott",
        "email": "bonscott@acdc.com",
        "created": "2018-02-01 20:33:12",
        "modified": "2018-02-01 20:33:12"
    }

### GET members/id/games
Request:
- Type: GET
- URL: localhost:8080/members/5/games

Response (200):

    [
        {
            "id": 1,
            "name": "Sonic the Hedgehog",
            "company": "SEGA",
            "created": "2018-02-01 19:12:51",
            "modified": "2018-02-01 19:12:51"
        },
        {...},
        {
            "id": 5,
            "name": "Gran Turismo 2",
            "company": "Sony",
            "created": "2018-02-01 19:16:38",
            "modified": "2018-02-01 19:16:38"
        }
    ]

### GET games
Request:
- Type: GET
- URL: localhost:8080/games

Response (200):

    [
        {
            "id": 1,
            "name": "Sonic the Hedgehog",
            "company": "SEGA",
            "created": "2018-02-01 19:12:51",
            "modified": "2018-02-01 19:12:51"
        },
        {...},
        {
            "id": 19,
            "name": "Wind Jammers",
            "company": "Nintendo",
            "created": "2018-02-01 19:18:50",
            "modified": "2018-02-01 19:18:50"
        }
    ]

### GET games/id
Request
- Type: GET
- URL: localhost:8080/games/1

Response (200):

    {
        "id": 1,
        "name": "Sonic the Hedgehog",
        "company": "SEGA",
        "created": "2018-02-01 19:12:51",
                "modified": "2018-02-01 19:12:51"
    }

### POST members
Request
- Type: POST
- URL: localhost:8080/members

Post data

    {
        "name": "Freddy",
        "surname": "Mercury",
        "email": "freddymercury@queen.com"
    }

Tip: Don't forget any field. The email must be unique.

Response (200):

    {
        "name": "Freddy",
        "surname": "Mercury",
        "email": "freddymercury@queen.com",
        "modified": "2018-02-01 21:00:53",
        "created": "2018-02-01 21:00:53",
        "id": 9
    }

### POST games
Request
- Type: POST
- URL: localhost:8080/games

Post data

    {
        "name": "Super Street Fighter",
        "company": "Sony"
    }

Tip: The company name is restricted to the next values:
- Nintendo
- SEGA
- Sony
- Microsoft

Response (200):

    {
        "name": "Super Street Fighter",
        "company": "Sony",
        "modified": "2018-02-01 20:58:44",
        "created": "2018-02-01 20:58:44",
        "id": 20
    }

### POST members/id/games/game_id
Request
- Type: POST
- URL: localhost:8080/members/5/games/7

Post data

    {
    }

Response (200):

    1
    
### PATCH members/id
Request
- Type: PATCH
- URL: localhost:8080/members/9

Post data

    {
        "name": "Freddy",
        "surname": "Mercury",
        "email": "freddymercury7@queen.com"
    }

Tip: The email must be unique.

Response (200):

    {
        "id": 9,
        "name": "Freddy",
        "surname": "Mercury",
        "email": "freddymercury7@queen.com",
        "created": "2018-02-01 21:00:53",
        "modified": "2018-02-01 21:10:03"
    }
    
### PATCH games/id
Request
- Type: PATCH
- URL: localhost:8080/games/20

Post data

    {
        "name": "Super Street Fighter",
        "company": "Nintendo"
    }

Tip: The company name is restricted to the next values:
- Nintendo
- SEGA
- Sony
- Microsoft

Response (200):

    {
        "id": 20,
        "name": "Super Street Fighter",
        "company": "Nintendo",
        "created": "2018-02-01 20:58:44",
        "modified": "2018-02-01 21:07:56"
    }
