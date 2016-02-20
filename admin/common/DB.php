<?php

class DB {

    const DB_HOST = '127.0.0.1:3307';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME     = 'softacad';

    private $connection;

    static $instance = null;

    private function __construct()
    {
        $connection = mysqli_connect(self::DB_HOST, self::DB_USERNAME, self::DB_PASSWORD);
        mysqli_select_db($connection, self::DB_NAME);
        $this->connection = $connection;
    }

    public static function getInstance() {
        if (DB::$instance === null) {
            DB::$instance = new DB();
        }
        return DB::$instance;
    }

    public function get($table, $where = null, $limit = -1)
    {
        $sql =  "SELECT * FROM {$table}";

        if ($where != null) {
            // users.id = 4;
            $sql .= " WHERE {$where} ";
        }

        if ($limit > -1) {
            $sql .= " LIMIT {$limit} ";
        }

        $result = mysqli_query($this->connection, $sql);

        if (!$result) {
           echo $this->showErrors();
        }

        $arrayResults = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $arrayResults[] = $row;
        }

        return $arrayResults;
    }

    private function showErrors() {
        $error = mysqli_error($this->connection);

        return $error;
    }

    public function create($table, $dataInput)
    {
        $sql="INSERT INTO {$table} SET ";


        $numItems = count($dataInput);
        $i = 0;
        foreach ($dataInput as $key => $value) {
            if (++$i == $numItems) {
                $sql.="{$key}='{$value}' ";
            } else {
                $sql.="{$key}='{$value}', ";
            }
        }

        mysqli_query($this->connection, $sql);
    }


    public function update($table, $id, $dataInput)
    {
        $sql =  "UPDATE {$table} SET ";
        $numItems = count($dataInput);
        $i = 0;
        foreach ($dataInput as $key => $value) {
            if (++$i == $numItems) {
                $sql.="{$key}='{$value}' ";
            } else {
                $sql.="{$key}='{$value}', ";
            }
        }
        $sql .= "WHERE id = {$id}";

        mysqli_query($this->connection, $sql);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";

        mysqli_query($this->connection, $sql);
    }
}