<?php

class ClientsCollection extends Collection {

    protected $entity = 'ClientsEntity';
    protected $table  = 'clients';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'username'  => $entity->getUsername(),
            'password'  => $entity->getPassword(),
            'email'     => $entity->getEmail(),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }

}