<?php
class Database
{
    private const DB_HOST = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "5_oop_books_rating";
    private $conn;

    public function __construct()
    {
        session_start();
        $this->conn = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
        if (!$this->conn) {
            die("Connection failed!");
        }
    }

    public function show_all($table)
    {
        $sql = "SELECT * FROM `$table`";
        $result = $this->conn->query($sql);
        $records = $result->fetch_all(MYSQLI_ASSOC);
        return $records;
    }

    public function show_single($table, $id)
    {
        $sql = "SELECT * FROM `$table` WHERE `id` = $id LIMIT 1";
        $result = $this->conn->query($sql);
        $record = $result->fetch_assoc();
        return $record;
    }

    public function create($table, $data)
    {
        $keys = array_keys($data);
        $keys = implode("`, `", $keys);
        $values = array_values($data);
        $values = implode("', '", $values);
        $sql = "INSERT INTO `$table`(`$keys`) VALUES ('$values')";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    public function update($table, $data, $id)
    {
        $pairs = [];
        foreach ($data as $key => $value) {
            array_push($pairs, "`$key` = '$value'");
        }
        $pairs = implode(", ", $pairs);
        $sql = "UPDATE `$table` SET $pairs WHERE `id` = $id";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM `$table` WHERE `id` = $id LIMIT 1";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if($user['type'] == "Admin") {
                $_SESSION['admin'] = $user;
                $output = "admin";
            } else {
                $_SESSION['user'] = $user;
                $output = "user";
            }
        } else {
            $output = "failure";
        }

        return $output;
    }

    public function logout()
    {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        } else {
            unset($_SESSION['user']); 
        }
        session_destroy();
        header('location: ./login.php');
    }

    public function is_email_already_exists($email)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows === 0) {
            return false;
        } else {
            return true;
        }
    }
}

$database = new Database();
