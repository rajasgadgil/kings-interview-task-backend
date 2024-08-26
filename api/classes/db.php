<?php

// Database Method to access local db
// Author: Rajas Gadgil

class Database
{
    //private credentials variables

    private $servername = "127.0.0.1:8889";
    private $username = "root";
    private $password = "root";
    private $database = "kingsinterview";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "db connected";
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    // user login function

    public function userlogin($loginuser, $loginpass)
    {
        if ($this->conn) {
            try {
                $getpassword = $this->conn->prepare("SELECT * FROM kcl_login WHERE username = :username");
                $getpassword->bindParam(':username', $loginuser);
                $getpassword->execute();
                $checkuserpassword = $getpassword->fetchAll(PDO::FETCH_ASSOC);
                if ($checkuserpassword) {

                    //password_verify function to verify password_hash values using one way encryption (bcrypt)

                    if (password_verify($loginpass, $checkuserpassword[0]['password'])) {


                        // JOIN user and string length storing tables 

                        $stmt = $this->conn->prepare("SELECT kc.id, kc.firstname, kc.lastname, kst.string_length FROM kcl_user AS kc LEFT JOIN kcl_stringtask AS kst ON kst.userid = kc.id WHERE kc.id = :userid");
                        $stmt->bindParam(':userid', $checkuserpassword[0]['userid']);
                        $stmt->execute();
                        $current_time = time();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($result) > 0) {
                            $updatelastlogin = $this->conn->prepare('UPDATE kcl_login SET lastlogin = :lastlogin WHERE userid = :userid');
                            $updatelastlogin->bindParam(':lastlogin', $current_time);
                            $updatelastlogin->bindParam(':userid', $checkuserpassword[0]['userid']);
                            $updatelastlogin->execute();

                            return ['response_id' => 2, 'username' => $result[0]['firstname'] . ' ' . $result[0]['lastname'], 'userid' => $result[0]['id'], 'stringlength' => ($result[0]["string_length"])];
                        } else {
                            return ['response_id' => 0];
                        }
                    } else {
                        return ['response_id' => 1];
                    }
                } else {
                    return ['response_id' => 0];
                }
            } catch (PDOException $e) {
                throw new Exception("Query failed: " . $e->getMessage());
            }
        } else {
            throw new Exception("No database connection.");
        }
    }

    // function to store string values if user has logged in

    public function setStringValue($userid, $stringcount, $string)
    {
        if ($this->conn) {
            $current_time = time();

            $getstringdata = $this->conn->prepare("SELECT * FROM kcl_stringtask WHERE userid = :userid");
            $getstringdata->bindParam('userid', $userid);
            $getstringdata->execute();
            $userstringdata = $getstringdata->fetchAll(PDO::FETCH_ASSOC);
            if (count($userstringdata) > 0) {

                //insert string length values for user

                $storestring = $this->conn->prepare("INSERT INTO kcl_stringtask 
                (userid,
                string_input,
                string_length,
                created_on) VALUES 
                (:userid,
                :string_input,
                :string_length,
                :created_on)");
                $storestring->bindParam(':userid', $userid);
                $storestring->bindParam(':string_input', $string);
                $storestring->bindParam(':string_length', $stringcount);
                $storestring->bindParam(':created_on', $current_time);
                $storestring->execute();

            } else {

                //update string value if user data already present

                $updatestring = $this->conn->prepare("UPDATE kcl_stringtask 
                SET userid = :userid,
                string_input = :string_input,
                string_length = :string_length, 
                created_on = :created_on
                WHERE userid = :userid");
                $updatestring->bindParam(':userid', $userid);
                $updatestring->bindParam(':string_input', $string);
                $updatestring->bindParam(':string_length', $stringcount);
                $updatestring->bindParam(':created_on', $current_time);
                $updatestring->execute();

            }
        } else {
            throw new Exception("No database connection.");
        }
    }
}
