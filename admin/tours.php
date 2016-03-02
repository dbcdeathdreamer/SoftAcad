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

$page = isset($_GET['page'])? (int)$_GET['page'] : 1;
$perPage = 5;
$offset  = ($page) ? ($page-1) * $perPage : 0;

$toursCollection = new ToursCollection();
$rows = count($toursCollection->getAll());

$pagination = new Pagination();
$pagination->setPerPage($perPage);
$pagination->setTotalRows($rows);
$pagination->setBaseUrl('http://localhost/Lectures/Lek15/softacadTours/admin/tours.php');

$tours = $toursCollection->getAll(array(), $offset, $perPage);

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
                            <td class="center"><?php echo $tour->getCategoryId(); ?></td>
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
