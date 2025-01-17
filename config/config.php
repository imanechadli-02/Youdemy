<?php
class Connection
{
    private $host = "localhost";
    private $db_name = "Youdemy";
    private $username = "root";
    private $password = "12345chadli";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            if ($this->conn->connect_error) {
                // echo 'Connection failed: ' . $this->conn->connect_error;
                die("Connection failed: " . $this->conn->connect_error);
                return null;
            } else {
                // echo 'Connected successfully to the database.';
                // die("Connected successfully to the database.");
            }
        } catch (Exception $e) {
            // echo 'Error while connecting: ' . $e->getMessage();
            die("Error while connecting: " . $e->getMessage());
        }

        return $this->conn;
    }
}
