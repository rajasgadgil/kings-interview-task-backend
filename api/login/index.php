<?php

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');

header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");
session_start();

require __DIR__ . "./../classes/db.php";

$body = file_get_contents('php://input');

$request = json_decode($body);
$username = htmlspecialchars(stripslashes(trim($request->username)));
$username = preg_replace('/\s+/', '', $username);
$password = $request->password;

if ($password) {
    $login = new Database();
    $user = $login->userlogin($username, $password);
    if ($user['response_id'] = 2) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['userid'] = $user['userid'];
    }
} else {
    $user = "Please enter password";
}

print(json_encode($user));
var_dump($_SESSION);