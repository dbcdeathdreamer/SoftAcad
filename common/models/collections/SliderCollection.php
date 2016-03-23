<?php

class SliderCollection extends Collection {

    protected $entity = 'SliderEntity';
    protected $table  = 'slider';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'image'  => $entity->getImage(),
            'order'  => $entity->getOrder(),
            'status' => $entity->getStatus(),
            'title'  => $entity->getTitle(),

        );


        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }

}