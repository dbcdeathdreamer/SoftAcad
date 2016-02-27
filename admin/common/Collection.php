<?php

class Collection {

    private $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll($table, $where = array(), $limit = -1, $offset = 0)
    {
        $sql = " SELECT * FROM {$table} ";

        $sql.= "WHERE 1=1";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }

        if ($limit > -1) {
            $sql.= "Limit {$limit}";

            if ($offset > 0) {
                $sql.= " , {$offset}";
            }
        }

        $result = $this->db->query($sql);

        if ($result  === false) {
            $this->db->error();
        }

        $collection = array();
        while ($row = $this->db->translate($result)) {
            $collection[] = $row;
        }

        return $collection;
    }




}
