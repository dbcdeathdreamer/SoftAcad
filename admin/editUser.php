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


    </div>


<?php
require_once('common/footer.php');
?>