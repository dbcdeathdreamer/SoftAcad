<?php
require_once('common/header.php');
if (!loggedIn()) {
    header('Location: login.php');
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

<?php


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
$pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/admin/tours.php?perPage={$perPageSelect}&orderBy={$orderBy}&search=$search");



$tours = $toursCollection->getAll(array(), $offset, $perPage, $order, $like);

?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Striped Table</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">

                <form action="tours.php" method="get" class="form-horizontal" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="inputError">Search</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="search" value="<?php echo htmlspecialchars(trim($search)) ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Results per page</label>
                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                            <div class="controls">
                                <select id="selectError3" name="perPage">
                                    <option value="0" <?php echo ($perPageSelect == 0)? "selected" : " " ?>>-- Select Order --</option>
                                    <option value="1" <?php echo ($perPageSelect == 1)? "selected" : " " ?>>5 per page</option>
                                    <option value="2" <?php echo ($perPageSelect == 2)? "selected" : " " ?>>10 per page</option>
                                    <option value="3" <?php echo ($perPageSelect == 3)? "selected" : " " ?>>20 per page</option>
                                    <option value="4" <?php echo ($perPageSelect == 4)? "selected" : " " ?>>50 per page</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError3">Category</label>
                            <div class="controls">
                                <select id="selectError3" name="orderBy">
                                    <option value="0" <?php echo ($orderBy == 0)? "selected" : " " ?>>-- Select Order --</option>
                                    <option value="1" <?php echo ($orderBy == 1)? "selected" : " " ?>>Name Up</option>
                                    <option value="2" <?php echo ($orderBy == 2)? "selected" : " " ?>>Name Down</option>
                                    <option value="3" <?php echo ($orderBy == 3)? "selected" : " " ?>>Category Up</option>
                                    <option value="4" <?php echo ($orderBy == 4)? "selected" : " " ?>>Category Down</option>
                                </select>
                            </div>
                        </div
                        <div class="form-actions">
                            <input type="submit" value="Order Results" class="btn btn-primary"/>
                        </div>
                    </fieldset>
                </form>


                <a href="addTour.php" class="btn btn-large btn-success pull-right">Create tour</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($tours as $tour): ?>
                        <tr>
                            <td><?php echo $tour->getName(); ?></td>
                            <td class="center"><?php echo $tour->getDescription(); ?></td>
                            <td class="center"><?php echo $tour->getCategoryName(); ?></td>
                            <td class="center"><img width="100" height="100" src="uploads/tours/<?php echo $tour->getImage(); ?>" alt=""></td>
                            <td class="center">
                                <a class="btn btn-success" href="tourImages.php?id=<?php echo $tour->getId();?>">
                                    <i class="halflings-icon white zoom-in"></i>
                                </a>
                                <a class="btn btn-info" href="editTour.php?id=<?php echo $tour->getId();?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="deleteTour.php?id=<?php echo $tour->getId();?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $pagination->create(); ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->




</div><!--/.fluid-container-->
<?php require_once('common/footer.php'); ?>
