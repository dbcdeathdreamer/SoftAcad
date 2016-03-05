<?php

class ToursImagesCollection extends Collection {

    protected $entity = 'ToursImagesEntity';
    protected $table  = 'tours_images';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'image'  => $entity->getImage(),
            'tours_id'  => $entity->getToursId(),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }

}