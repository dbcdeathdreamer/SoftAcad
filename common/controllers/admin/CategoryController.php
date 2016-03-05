<?php

class CategoryController extends Controller {

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

        $categoryCollection = new CategoryCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;


        $rows = count($categoryCollection->getAll());

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/admin/index.php?c=category&m=index");

        $categories = $categoryCollection->getAll(array(), $offset, $perPage);

        $data['categories'] = $categories;
        $data['pagination'] = $pagination;

        $this->loadView('category/listing', $data);

    }

}