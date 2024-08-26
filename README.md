# kings-task-backend

This project consists of three api endpoints:
1: /api/login/
2: /api/submit/
3: /api/session/

For TASK 1:

URL: http://127.0.0.1:8000/api/submit/


For TASK 2:

URL: http://127.0.0.1:8000/api/login/


For BONUS TASK 3:

URL: http://127.0.0.1:8000/api/session/getsession.php

URL: http://127.0.0.1:8000/api/session/removesession.php


APIs are standard REST APIs called using HTTP requests.

Connections are made using PDO mysql for complete security

Sessions are used to store user data across the server

# Running the server

Set MySQL Port to 8889

Set server port is set to 8000

Set HOST to 127.0.0.1

kingsinterview.sql is the sql backup of local database

Host name of front-end/request should be set to 127.0.0.1 to avoid CORS and browser restrictions while requesting APIs from this server

This setup was created and tested using MAMP on MAC OS (not been tested on XAMPP/WAMP/DOCKER)
