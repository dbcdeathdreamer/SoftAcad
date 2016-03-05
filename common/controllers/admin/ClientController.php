<?php

class ClientController extends Controller {

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

        $clientsCollection = new ClientsCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = count($clientsCollection->getAll());

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/admin/index.php?c=client&m=index");

        $users = $clientsCollection->getAll(array(), $offset, $perPage);

        $data['users'] = $users;
        $data['pagination'] = $pagination;

        $this->loadView('clients/listing', $data);

    }

}