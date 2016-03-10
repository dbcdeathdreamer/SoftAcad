<?php

class DashboardController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        $data = array();
        //users
        $userCollection = new UserCollection();
        $users = count($userCollection->getAll());

        //customers
        $clientCollection = new ClientsCollection();
        $client = count($clientCollection->getAll());

        //tours
        $toursCollection = new ToursCollection();
        $tours = count($toursCollection->getAll());

        //blog posts
        $blogpostCollection = new BlogCollection();
        $blogs = count($blogpostCollection->getAll());


        $data['users'] = $users;
        $data['client'] = $client;
        $data['tours'] = $tours;
        $data['blogs'] = $blogs;

        $this->loadView('dashboard', $data);
    }


}