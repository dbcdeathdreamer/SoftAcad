<?php

class DB  {

    private static $instance = null;
    private $connection      = null;

    const DB_HOST = '127.0.0.1:3307';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_DATABASE = 'softacad';


    private function __construct()
    {
        $connection = mysqli_connect(self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_DATABASE);

        $this->connection =  $connection;
    }

    static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function translate($result)
    {
        return mysqli_fetch_assoc($result);
    }

    public function lastId()
    {
        mysqli_insert_id($this->connection);
    }

    public function error()
    {
        die(mysqli_error($this->connection));
    }
}




