<?php

class BlogImagesCollection extends Collection {

    protected $entity = 'BlogImagesEntity';
    protected $table  = 'blog_images';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'blog_post_id' => $entity->getBlogPostId(),
            'image' => $entity->getImage(),

        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }

    }

}