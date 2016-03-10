<?php

class ToursController extends Controller {


    public function index()
    {
        $data = array();

        $categoryId = isset($_GET['id'])? $_GET['id']: 0;

        $toursCollection = new ToursCollection();



        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        $perPage = 6;
        $offset  = ($page) ? ($page-1) * $perPage : 0;


        if ($categoryId > 0 ) {
            $where = array('category_id' => $categoryId);
            $rows = count($toursCollection->getAll($where));
            $tours = $toursCollection->getAll($where, $offset, $perPage);
        } else {
            $rows = count($toursCollection->getAll());
            $tours = $toursCollection->getAll(array(), $offset, $perPage);
        }

        $pagination = new Pagination();
        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($rows);
        $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/index.php?c=tours&m=index&id=".$categoryId);

        $data['pagination'] = $pagination;
        $data['tours'] = $tours;

        $this->loadFrontView('tours/listing', $data);
    }

    public function show()
    {
        $data = array();

        $tourId = isset($_GET['id'])? (int)$_GET['id']: 0;
        
        if($tourId == 0) {
            header("Location: index.php?c=tours");
        }
        
        $toursCollection = new ToursCollection();
        $tour = $toursCollection->getOne($tourId);

        if ($tour === null) {
            header("Location: index.php?c=tours");
        }

        $tourImagesCollection = new ToursImagesCollection();
        $tourImages = $tourImagesCollection->getAll(array('tours_id' => $tour->getId()));
        
        $data['tour'] = $tour;
        $data['tourImages'] = $tourImages;

        $this->loadFrontView('tours/show', $data);
    }
}
