<?php

class BlogController extends Controller {


    public function index()
    {
        $data = array();

        $blogCollection = new BlogCollection();

        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page) ? ($page-1) * $perPage : 0;

        $rows = count($blogCollection->getAll());

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/index.php?c=blog&m=index");

        $blogs = $blogCollection->getAll(array(), $offset, $perPage);

        $data['blogs'] = $blogs;
        $data['pagination'] = $pagination;

        $this->loadFrontView('blog/listing', $data);
    }

    public function show()
    {
        $data = array();

        $blogId = isset($_GET['id'])? (int)$_GET['id']: 0;

        if($blogId == 0) {
            header("Location: index.php?c=blog");
        }

        $blogCollection = new BlogCollection();
        $blog = $blogCollection->getOne($blogId);

        if ($blog === null) {
            header("Location: index.php?c=blog");
        }

        $blogImagesCollection = new BlogImagesCollection();
        $blogImages = $blogImagesCollection->getAll(array('blog_post_id' => $blog->getId()));

        $data['blog'] = $blog;
        $data['blogImages'] = $blogImages;

        $this->loadFrontView('blog/show', $data);
    }
}