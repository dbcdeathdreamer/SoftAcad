<?php

class ToursImagesEntity extends Entity
{

    private $id;
    private $image;
    private $toursId;

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

    public function setToursId($toursId)
    {
        $this->toursId = $toursId;
    }

    public function getToursId()
    {
        return $this->toursId;
    }


}