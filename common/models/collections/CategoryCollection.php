<?php
class CategoryCollection extends Collection {

    protected $table = 'categories';
    protected $entity = 'CategoryEntity';

    public function save(Entity $entity)
    {
        $dataInput = array(
            'name' => $entity->getName(),
            'description' => $entity->getDescription(),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }

}