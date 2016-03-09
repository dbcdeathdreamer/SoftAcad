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

    public function create()
    {
        $data = array();

        $insertInfo = array(
            'title'       => '',
            'image'       => '',
            'description' => '',

        );
        $errors = array();

        if (isset($_POST['addBlogPost'])) {
            $fileUpload = new fileUpload('image');
            $file = $fileUpload->getFilename();
            $fileExtention = $fileUpload->getFileExtention();

            $imageErrors = array();
            if ($file != '') {
                $imageErrors = $fileUpload->validate();
                $newName = sha1(time()) . '.' . $fileExtention;
            } else {
                $newName = '';
            }

            $insertInfo = array(
                'title'       => $_POST['title'],
                'image'       => $newName,
                'description' => $_POST['description'],

            );

            if (empty($imageErrors) && empty($errors)) {
                $blogPostEntity = new BlogEntity();
                $obj = $blogPostEntity->init($insertInfo);

                $blogPostCollection = new BlogCollection();
                $blogPostCollection->save($obj);

                $fileUpload->upload('uploads/tours/' . $newName);

                header("Location: index.php?c=blog&m=index");
            }
        }

        $data['insertInfo'] = $insertInfo;
        $data['errors'] = $errors;

        $this->loadView('blog/create', $data);
    }

    public function update() {

    }

    public function delete()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?c=blog&m=index');
        }

        $blogCollection = new BlogCollection();
        $blog = $blogCollection->getOne($_GET['id']);

        if (is_null($blog)) {
            header('Location: index.php?c=blog&m=index');
        }

        $blogCollection->delete($blog->getId());
        header('Location: index.php?c=blog&m=index');
    }


    public function blogImages()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        $data = array();

        if (!isset($_GET['id'])) {
            header('Location: index.php?c=blog&m=index');
        }

        $blogCollection = new BlogCollection();
        $blog = $blogCollection->getOne($_GET['id']);

        if (is_null($blog)) {
            header('Location: index.php?c=blog&m=index');
        }

        $blogImagesCollection = new BlogImagesCollection();
        $images = $blogImagesCollection->getAll(array('blog_post_id' => $_GET['id']));


        $fileUpload = new fileUpload('image');
        $file = $fileUpload->getFilename();

        $fileExtention = $fileUpload->getFileExtention();

        $imageErrors = array();

        if ($file != '') {

            $imageErrors =  $fileUpload->validate();
            $newName = sha1(time()).'.'.$fileExtention;
            $insertInfo = array(
                'blog_post_id' => $_GET['id'],
                'image' => $newName
            );

            if (empty($imageErrors)) {

                $imageEntity = new BlogImagesEntity();
                $obj =  $imageEntity->init($insertInfo);
                $blogImagesCollection->save($obj);

                $fileUpload->upload('uploads/tours/'.$newName);

                header("Location: index.php?c=blog&m=blogImages&id=".$_GET['id']);
            }
        } else {

        }

        $data['imageErrors'] = $imageErrors;
        $data['images'] = $images;
        $data['blogId'] = $_GET['id'];

        $this->loadView('blog/blogImages', $data);

    }

    public function deleteBlogImage()
    {
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        if(!isset($_GET['id'])) {
            header('Location: index.php?c=blog&m=index');
        }

        $imageCollection = new BlogImagesCollection();

        $image = $imageCollection->getOne($_GET['id']);

        if(is_null($image)) {
            header('Location: index.php?c=blog&m=index');
        }

        $tourId = $image->getBlogPostId();

        unlink('uploads/tours/'.$image->getImage());
        $imageCollection->delete($_GET['id']);

        header("Location: index.php?c=blog&m=blogImages&id=".$tourId);
    }



}