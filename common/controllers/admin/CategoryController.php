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

    public function create() {
        $data = array();

        $insertInfo = array(
            'name' => '',
            'description' => '',
        );
        $errors = array();

        if (isset($_POST['createCategory'])) {
            if (!isset($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 255) {
                $errors['name'] = 'Incorrect name';
            }

            if (!isset($_POST['description']) || strlen($_POST['description']) < 3 || strlen($_POST['description']) > 255) {
                $errors['description'] = 'Incorrect description';
            }

            if (empty($errors)) {
                $insertInfo['name'] = $_POST['name'];
                $insertInfo['description'] = $_POST['description'];

                $table = 'categories';

                $categoryEntity = new CategoryEntity();
                $obj = $categoryEntity->init($insertInfo);

                $categoryCollection = new CategoryCollection();
                $categoryCollection->save($obj);

                header('Location: index.php?c=category&m=index');
            }

        }

        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        $this->loadView('category/create', $data);
    }

    public function update() {

    }

    public function delete()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?c=category&m=index');
        }

        $categoryCollection = new CategoryCollection();
        $category = $categoryCollection->getOne($_GET['id']);

        if (is_null($category)) {
            header('Location: index.php?c=category&m=index');
        }

        $categoryCollection->delete($category->getId());
        header('Location: index.php?c=category&m=index');
    }

}