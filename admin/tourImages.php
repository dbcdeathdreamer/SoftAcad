<?php
require_once('common/header.php');


if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: tours.php');
}

$tourCollection = new ToursCollection();
$tour = $tourCollection->getOne($_GET['id']);

if(is_null($tour)) {
    header('Location: tours.php');
}


$tourImagesCollection = new ToursImagesCollection();
$images = $tourImagesCollection->getAll(array('tours_id' => $_GET['id']));




$fileUpload = new fileUpload('image');
$file = $fileUpload->getFilename();

$fileExtention = $fileUpload->getFileExtention();

$imageErrors = array();

if ($file != '') {
   
    $imageErrors =  $fileUpload->validate();
    $newName = sha1(time()).'.'.$fileExtention;
    $insertInfo = array(
        'tours_id' => $_GET['id'],
        'image' => $newName
    );

    if (empty($imageErrors)) {

       $imageEntity = new ToursImagesEntity();
       $obj =  $imageEntity->init($insertInfo);
       $tourImagesCollection->save($obj);

        $fileUpload->upload('uploads/tours/'.$newName);

        header("Location: tourImages.php?id=".$_GET['id']);
    }
} else {

}





?>
    <link id="bootstrap-style" href="css/images.css" rel="stylesheet">
<?php require_once('common/sidebar.php'); ?>
    <!-- start: Content -->
    <div id="content" class="span10" xmlns="http://www.w3.org/1999/html">

        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.php">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Tour Images</a></li>
        </ul>

        <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="fileInput">File input</label>
                    <div class="controls">
                        <input class="input-file uniform_on" id="fileInput" name="image" type="file">
                        <input type="submit" name="createTour" value="Add Tour" class="btn btn-primary"/>
                    </div>
                </div>

            </fieldset>
        </form>


        <div class="container">
            <div class="row">
                <?php foreach($images as $image): ?>
                    <div class="span3 ">
                        <a href="deleteTourImage.php?id=<?php echo $image->getId(); ?>" class="btn btn-mini btn-danger ">Delete</a>
                        <img style="width:270px; height:220px;" class="img-responsive" src="uploads/tours/<?php echo  $image->getImage(); ?>" />
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>


<?php
require_once('common/footer.php');
?>