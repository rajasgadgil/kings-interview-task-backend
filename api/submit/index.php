<?php
session_start();

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://127.0.0.1:3000');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

require __DIR__."./../classes/db.php";

$input_string = file_get_contents('php://input');
$input_string = json_decode($input_string);
$input_string = str_replace(' ','',$input_string->text);
$string_length = strlen($input_string);

if($string_length){

    if(isset($_SESSION['userid'])){
        $store_stringvalue = new Database();
        $store_stringvalue->setStringValue($_SESSION['userid'], $string_length, $input_string);
        $_SESSION['stringlength'] = $string_length;
    }
    
    print(json_encode(['message'=>$string_length]));

}else{
    print("Please enter a number");
}
