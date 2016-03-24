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

public function addToBasket(){


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['basket'][] = array(
            'id' => $_POST['tourId'],
            'quantity' => $_POST['quantity']
        );
    }

    $result = array(
        'quantity' => $_POST['quantity'],
        'id'       => $_POST['tourId'],
        'basketCount' => count($_SESSION['basket'])
    );
    echo json_encode($result);
    die;
}

}