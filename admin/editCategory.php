<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: clients.php');
}
$categoryCollection = new CategoryCollection();
$category = $categoryCollection->getOne($_GET['id']);

if(is_null($category)) {
    header('Location: categories.php');
}

$insertInfo = array(
    'name' => $category->getName(),
    'description'    => $category->getDescription(),
);

$errors = array();

if(isset($_POST['editCategory'])) {

    $insertInfo = array(
        'name' => (isset($_POST['name']))? $_POST['name'] : '',
        'description' => (isset($_POST['description']))? $_POST['description'] : '',

    );

    if (!isset($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 255) {
        $errors['name'] = 'Incorrect name';
    }

    if (!isset($_POST['description']) || strlen($_POST['description']) < 3 || strlen($_POST['description']) > 255) {
        $errors['description'] = 'Incorrect description';
    }
    if (empty($errors)) {
        $categoryEntity =  new CategoryEntity();
        $categoryEntity->setId($_GET['id']);
        $obj = $categoryEntity->init($insertInfo);
        $categoryCollection->save($obj);

        $_SESSION['flashMessage'] = 'You have 1 affected row';
        header('Location: categories.php');
    }


} ?>



<?php
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

        <form action="" method="post"  class="form-horizontal">
            <fieldset>
                <div class="control-group <?php echo (array_key_exists('name', $errors))? 'error' : ''; ?>">
                    <label class="control-label" for="inputError">Name</label>
                    <div class="controls">
                        <input type="text" id="inputError" name="name" value="<?php echo $insertInfo['name']; ?>" >
                        <?php if (array_key_exists('name', $errors)): ?>
                            <span class="help-inline"><?php echo $errors['name']; ?></span>
                        <?php  endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo (array_key_exists('description', $errors))? 'error' : ''; ?>">
                    <label class="control-label" for="inputError">Description</label>
                    <div class="controls">
                        <input type="text" id="inputError" name="description" value="<?php echo $insertInfo['description']; ?>">
                        <?php if (array_key_exists('description', $errors)): ?>
                            <span class="help-inline"><?php echo $errors['description']; ?></span>
                        <?php  endif; ?>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" name="editCategory" value="Edit Category" class="btn btn-primary"/>
                </div>
            </fieldset>
        </form>


    </div>


<?php
require_once('common/footer.php');
?>