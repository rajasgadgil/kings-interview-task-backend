<?php

// REST API PHP to get session value from the server
// Author: Rajas Gadgil

session_start();

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://127.0.0.1:3000');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

require __DIR__ . "./../classes/db.php";


if (isset($_SESSION)) {

    // if session is set print the session
    
    print(json_encode($_SESSION));

} else {

    print(json_encode(["message"=>"No session found"]));

}

