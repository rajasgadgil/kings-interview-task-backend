<?php

// REST API PHP for logging user in and storing user data in a local session
// Author: Rajas Gadgil

session_start();

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://127.0.0.1:3000');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

require __DIR__ . "./../classes/db.php";

// get POST request body elements

$body = file_get_contents('php://input');

$request = json_decode($body);

// functions to avoid XSS and SQL injection attacks

$username = htmlspecialchars(stripslashes(trim($request->username)));

// basic regex to remove any white space from the username string

$username = preg_replace('/\s+/', '', $username);

$password = $request->password;

if ($password && $username) {
    $login = new Database();
    $user = $login->userlogin($username, $password);

    if (isset($user['response_id']) && $user['response_id'] == 2) {    
        $_SESSION['username'] = $user['username'];
        $_SESSION['userid'] = $user['userid'];
        $_SESSION['stringlength'] = $user['stringlength'];
    }
} else {
    $user = ["response_id" => 3];
}

print(json_encode($user));
