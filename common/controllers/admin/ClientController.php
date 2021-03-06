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

    public function create() {
        $data = array();

        $clientCollection = new ClientsCollection();

        $insertInfo = array(
            'username' => '',
            'password' => '',
            'email'    => '',
        );
        $errors = array();
        if(isset($_POST['createUser'])) {

            $insertInfo = array(
                'username' => (isset($_POST['username']))? $_POST['username'] : '',
                'password' => (isset($_POST['password']))? $_POST['password'] : '',
                'email'    => (isset($_POST['email']))? $_POST['email'] : '',
            );

            $errors = $this->validateUserInput($insertInfo);

            if (empty($errors)) {
                $clientEntity = new ClientsEntity();

                $obj = $clientEntity->init($insertInfo);

                $clientCollection->save($obj);

                $_SESSION['flashMessage'] = 'You have 1 new user';
                header('Location: index.php?c=client&m=index');
            }
        }

        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        $this->loadView('clients/create', $data);
    }

    public function update() {

    }

    public function delete()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?c=client&m=index');
        }

        $clientCollection = new ClientsCollection();
        $client = $clientCollection->getOne($_GET['id']);

        if (is_null($client)) {
            header('Location: index.php?c=client&m=index');
        }

        $clientCollection->delete($client->getId());
        header('Location: index.php?c=client&m=index');
    }

    private function validateUserInput($input)
    {
        $errors = array();

        if (!isset($input['username']) || strlen(trim($input['username'])) < 3 || strlen(trim($input['username'])) > 255) {
            $errors['username'] = 'Incorrect username';
        }

        return $errors;
    }
}