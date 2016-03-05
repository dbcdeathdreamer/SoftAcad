<?php

class TourController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();

        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }


        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        if (trim($search) != '') {
            $like = array('name', htmlspecialchars(trim($search)));
        } else {
            $like = array();
        }


        $perPageSelect = (isset($_GET['perPage'])) ? (int)$_GET['perPage'] : 0;
        switch ($perPageSelect) {
            case 0:
                $perPage = 10;
                break;
            case 1:
                $perPage = 5;
                break;
            case 2:
                $perPage = 10;
                break;
            case 3:
                $perPage = 20;
                break;
            case 4:
                $perPage = 50;
                break;
            default:
                $perPage = 10;
        }


        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;

        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('name', 'ASC');
                break;
            case 2:
                $order = array('name', 'DESC');
                break;
            case 3:
                $order = array('category_id', 'ASC');
                break;
            case 4:
                $order = array('category_id', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }


        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;

        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $toursCollection = new ToursCollection();

        $rows = (count($toursCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($toursCollection->getAll(array(), -1, 0, $order, $like));

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/admin/index.php?c=tour&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$search");

        $tours = $toursCollection->getAll(array(), $offset, $perPage, $order, $like);

        $data['tours'] = $tours;
        $data['pagination'] = $pagination;
        $data['search'] = $search;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;


        $this->loadView('tours/listing', $data);
    }

}