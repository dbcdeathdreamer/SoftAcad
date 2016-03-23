<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/sidebar.php'; ?>
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
                <?php
                if (isset($_SESSION['flashMessage'])) {
                    echo $_SESSION['flashMessage'];
                    unset($_SESSION['flashMessage']);
                }
                ?>

                <a href="index.php?c=slider&m=create" class="btn btn-large btn-success pull-right">Create new slide</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Order</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($slides as $slide): ?>
                        <tr>
                            <td><?php echo $slide->getTitle(); ?></td>
                            <td class="center"><?php echo $slide->getImage(); ?></td>
                            <td class="center"><?php echo $slide->getStatus(); ?></td>
                            <td class="center"><?php echo $slide->getOrder(); ?></td>
                            <td class="center">
                                <a class="btn btn-info" href="index.php?c=slider&m=update&id=<?php echo $slide->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=slider&m=delete&id=<?php echo $slide->getId(); ?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo  $pagination->create(); ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->

</div><!--/.fluid-container-->

<?php require_once __DIR__.'/../include/footer.php'; ?>
