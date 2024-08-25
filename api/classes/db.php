<?php

class Database
{
    private $servername = "127.0.0.1:8889";
    private $username = "root";
    private $password = "root";
    private $database = "kingsinterview";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo "Connected successfully";
        } catch (PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function userlogin($loginuser, $loginpass)
    {
        if ($this->conn) {
            try {
                $getpassword = $this->conn->prepare("SELECT * FROM kcl_login WHERE username = :username");
                $getpassword->bindParam(':username', $loginuser);
                $getpassword->execute();
                $checkuserpassword = $getpassword->fetchAll(PDO::FETCH_ASSOC);
                if ($checkuserpassword) {
                    if (password_verify($loginpass, $checkuserpassword[0]['password'])) {
                        $stmt = $this->conn->prepare("SELECT * FROM kcl_user WHERE id = :userid");
                        $stmt->bindParam(':userid', $checkuserpassword[0]['userid']);
                        $stmt->execute();
                        $current_time = time();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($result) > 0) {
                            $updatelastlogin = $this->conn->prepare('UPDATE kcl_login SET lastlogin = :lastlogin WHERE userid = :userid');
                            $updatelastlogin->bindParam(':lastlogin', $current_time);
                            $updatelastlogin->bindParam(':userid', $checkuserpassword[0]['userid']);
                            $updatelastlogin->execute();
                            return ['response_id' => 2, 'username' => $result[0]['firstname'] . ' ' . $result[0]['lastname'], 'userid' => $result[0]['id']];
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

    public function setStringValue($userid, $stringcount, $string)
    {
        if ($this->conn) {
            $current_time = time();

            $getstringdata = $this->conn->prepare("SELECT * FROM kcl_stringtask WHERE userid = :userid");
            $getstringdata->bindParam('userid', $userid);
            $getstringdata->execute();
            $userstringdata = $getstringdata->fetch(PDO::FETCH_ASSOC);

            $condition = (count($userstringdata) == 0) ? 0 : 1;

            switch ($condition) {
                case 0:
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
                    break;

                case 1:
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
                    break;
            }
        } else {
            throw new Exception("No database connection.");
        }
    }
}
