<?php

class BlogController extends Controller {

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

        $blogCollection = new BlogCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = count($blogCollection->getAll());

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/admin/index.php?c=blog&m=index");

        $blogPosts = $blogCollection->getAll(array(), $offset, $perPage);

        $data['blogPosts'] = $blogPosts;
        $data['pagination'] = $pagination;

        $this->loadView('blog/listing', $data);
    }

}