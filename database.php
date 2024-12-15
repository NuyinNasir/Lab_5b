<?php
class Database //state the class name as Database
{
    private $host = "localhost"; //private to seen in PHP code only and store the database host
    private $username = "root"; //private to seen in PHP code only and store the database username
    private $password = "123"; //private to seen in PHP code only and store the password
    public $conn; //public to seen in HTML code too as a database connection object

    public function connect() //a method to return database connection
    {   //mysqli connection that stored all these data
        $this->conn = new mysqli($this->host, $this->username, $this->password);

        //check if the connection successful
        if ($this->conn->connect_error) {
            die("The connection isn't successful!" . $this->conn->connect_error);
        } else {
        //successfully connected
        }

        return $this->conn; //return statement
    }
}