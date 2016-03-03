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

                <a href="addUser.php" class="btn btn-large btn-success pull-right">Create new user</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $usersCollection = new UserCollection();

                    $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
                    $perPage = 5;
                    $offset  = ($page) ? ($page-1) * $perPage : 0;


                    $rows = count($usersCollection->getAll());

                    $pagination = new Pagination();
                    $pagination->setPerPage($perPage);
                    $pagination->setTotalRows($rows);
                    $pagination->setBaseUrl("http://localhost/Lectures/Lek15/softacadTours/admin/users.php");

                    $users = $usersCollection->getAll(array(), $offset, $perPage);

                    foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user->getUsername(); ?></td>
                            <td class="center"><?php echo $user->getEmail(); ?></td>
                            <td class="center"><?php echo $user->getDescription(); ?></td>
                            <td class="center">

                                <a class="btn btn-info" href="editUser.php?id=<?php echo $user->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="deleteUser.php?id=<?php echo $user->getId(); ?>">
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
