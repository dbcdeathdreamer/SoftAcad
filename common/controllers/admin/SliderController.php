<?php

class SliderController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=slider&m=index');
        }
        $data = array();

        $sliderCollection = new SliderCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = (count($sliderCollection->getAll()) > 0 ) ? count($sliderCollection->getAll()) : '1' ;

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/admin/index.php?c=slider&m=index");

        $slides = $sliderCollection->getAll(array(), $offset, $perPage);

        $data['slides'] = $slides;
        $data['pagination'] = $pagination;

        $this->loadView('slider/listing', $data);

    }

    public function create() {
        $data = array();

        $categoryCollection = new CategoryCollection();
        $categories = $categoryCollection->getAll();

        $insertInfo = array(
            'title' => '',
            'image' => '',

        );
        $errors = array();

        if (isset($_POST['createSlide'])) {


            $fileUpload = new fileUpload('image');
            $file = $fileUpload->getFilename();
            $fileExtention = $fileUpload->getFileExtention();

            $imageErrors = array();
            if ($file != '') {
                $imageErrors =  $fileUpload->validate();
                $newName = sha1(time()).'.'.$fileExtention;
            } else {
                $newName = '';
            }

            $insertInfo = array(
                'title' => $_POST['title'],
                'image' => $newName,

            );

            if (empty($imageErrors) && empty($errors)) {

                $toursCollection = new SliderCollection();
                $toursEntity = new SliderEntity();
                $obj = $toursEntity->init($insertInfo);

                $toursCollection->save($obj);

                $fileUpload->upload('uploads/tours/'.$newName);

                header("Location: index.php?c=slider&m=index");
            }
        }

        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        $this->loadView('slider/create', $data);
    }

    public function update() {

    }

    public function reorder() {
        $data = array();

        $sliderCollection = new SliderCollection();
        $slides = $sliderCollection->getAll(array(), -1, 0, array('`order` ', 'ASC'));


        if (isset($_POST['reorder'])) {
          $postSlides = $_POST['slides'];

          foreach ($postSlides as $key => $slide) {
             $sliderCollection->update($slide, array('order' => $key));
          }

            header("Location: index.php?c=slider&m=reorder");
        }



        $data['slides'] = $slides;

        $this->loadView('slider/reorder', $data);
    }

    public function delete()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=slider&m=login');
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?c=slider&m=index');
        }

        $sliderCollection = new SliderCollection();
        $slider = $sliderCollection->getOne($_GET['id']);

        if (is_null($slider)) {
            header('Location: index.php?c=slider&m=index');
        }

        $sliderCollection->delete($slider->getId());
        header('Location: index.php?c=slider&m=index');
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