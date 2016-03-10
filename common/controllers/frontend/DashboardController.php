<?php

class DashboardController extends Controller {


public function index()
{
    $data = array();
    
    //last 3 blog posts
    $blogCollection = new BlogCollection();
    $lastBlogposts = $blogCollection->getAll(array(), 3, 0, array('id', 'DESC'));

    //random 6 tours
    $toursCollection = new ToursCollection();
    $randomTours = $toursCollection->getAll(array(), 6, 0, array('id', 'desc'), array(), 1);

    $data['lastBlogPosts'] = $lastBlogposts;
    $data['randomTours']   = $randomTours;
    
    $this->loadFrontView('landingPage', $data);

}



}