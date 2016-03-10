<?php

class ToursCollection extends Collection {

    protected $entity = 'ToursEntity';
    protected $table  = 'tours';



    public function getAll($where = array(), $limit = -1, $offset = 0 , $orderBy = array('id', 'DESC'), $like = array(), $rand = 0 )
    {
        $sql = " SELECT
          t.id, t.name, t.image, t.category_id, t.description,
          c.name as category_name
        FROM {$this->table}  as t ";

        $sql .= " JOIN categories as c ON c.id = t.category_id ";

        $sql.= " WHERE 1=1 ";

        if (!empty($like)) {
            $sql.= " AND t.{$like[0]} LIKE '%{$like[1]}%' ";
        }

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }

        if ($rand == 1) {
            $sql.= " ORDER BY RAND() ";
        } else {
            $sql.= " ORDER BY {$orderBy[0]} {$orderBy[1]} ";
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
            $entity = new $this->entity;
            $entityRow = $entity->init($row);

            $collection[] = $entityRow;
        }

        return $collection;
    }



    public function save(Entity $entity)
    {
        $dataInput = array(
            'name' => $entity->getName(),
            'image' => $entity->getImage(),
            'category_id' => $entity->getCategoryId(),
            'description' => $entity->getDescription(),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }

    }



}