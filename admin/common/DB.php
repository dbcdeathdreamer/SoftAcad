<?php

class DB {

    const DB_HOST = '127.0.0.1';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME     = 'softacad';

    private $connection;

    public function __construct()
    {
        $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
        mysqli_select_db($connection, DB_NAME);
        $this->connection = $connection;
    }

    public function get($table, $where = null, $limit = -1)
    {
        $sql =  "SELECT * FROM { $table }";

        if ($where != null) {
            // users.id = 4;
            $sql .= "WHERE { $where }";
        }

        if ($limit > -1) {
            $sql .= "LIMIT {$limit}";
        }

        $result = mysqli_query($this->connection, $sql);

        $arrayResults = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $arrayResults[] = $row;
        }

        return $arrayResults;
    }


    public function create($table, $dataInput)
    {
        $sql="INSERT INTO {$table} SET ";
        foreach ($dataInput as $key => $value) {
            if($value != end($dataInput)){
                $sql.="{$key}='{$value}', ";
            }else{
                $sql.="{$key}='{$value}' ";
            }
        }
        mysqli_query($this->connection,$sql);
    }


    public function update()
    {

    }

    public function delete()
    {

    }


}