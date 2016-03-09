<?php

class BlogImagesEntity extends Entity
{

    private $id;
    private $image;
    private $blogPostId;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setBlogPostId($blogPostId)
    {
        $this->blogPostId = $blogPostId;
    }

    public function getBlogPostId()
    {
        return $this->blogPostId;
    }

}