<?php

class BlogCollection extends Collection {

    protected $entity = 'BlogEntity';
    protected $table  = 'blog';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'image' => $entity->getImage(),
            'title' => $entity->getTitle(),
            'description' => $entity->getDescription(),
            'created_at' => $entity->getCreatedAt(),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }

    }



}