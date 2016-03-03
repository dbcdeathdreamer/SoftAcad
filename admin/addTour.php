<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}
?>
<?php

$categoryCollection = new CategoryCollection();
$categories = $categoryCollection->getAll();

$insertInfo = array(
    'name' => '',
    'image' => '',
    'category_id' => '',
    'description' => '',

);
$errors = array();

if (isset($_POST['createTour'])) {


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
        'name' => $_POST['name'],
        'image' => $newName,
        'category_id' => $_POST['categories'],
        'description' => $_POST['description'],

    );

    if (empty($imageErrors) && empty($errors)) {

        $toursCollection = new ToursCollection();
        $toursEntity = new ToursEntity();
        $obj = $toursEntity->init($insertInfo);

        $toursCollection->save($obj);

        $fileUpload->upload('uploads/tours/'.$newName);

        header("Location: tours.php");
    }
}
require_once('common/sidebar.php');
?>
    <!-- start: Content -->
    <div id="content" class="span10">


        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.php">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Dashboard</a></li>
        </ul>

        <form action="addTour.php" method="post"   class="form-horizontal" enctype="multipart/form-data">
            <fieldset>
                <div class="control-group <?php echo (array_key_exists('name', $errors))? 'error' : ''; ?>">
                    <label class="control-label" for="inputError">Name</label>
                    <div class="controls">
                        <input type="text" id="inputError" name="name" value="">
                        <?php if (array_key_exists('name', $errors)): ?>
                            <span class="help-inline"><?php echo $errors['name']; ?></span>
                        <?php  endif; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError3">Category</label>
                    <div class="controls">
                        <select id="selectError3" name="categories">
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
                            <?php endforeach; ?>
                           
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="fileInput">File input</label>
                    <div class="controls">
                        <input class="input-file uniform_on" id="fileInput" name="image" type="file">

                    </div>
                </div>
                <div class="control-group hidden-phone">
                    <label class="control-label" for="textarea2">Description</label>
                    <div class="controls">
                        <textarea name="description" class="cleditor" id="textarea2" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" name="createTour" value="Add Tour" class="btn btn-primary"/>
                </div>
            </fieldset>
        </form>


    </div>


<?php
require_once('common/footer.php');
?>