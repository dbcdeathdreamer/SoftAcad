<?php

class Collection {

    private $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll($table, $fields = array() , $where = array(), $limit = -1, $offset = 0)
    {
        $sql = " SELECT ";
        if(empty($fields)) {
            $sql.= " * ";
        } else {
            foreach ($fields as $field) {
                $sql .= " $field, ";
            }
        }

        $sql .= " FROM {$table} ";

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
