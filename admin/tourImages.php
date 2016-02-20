<?php
require_once('common/header.php');


if (!loggedIn()) {
    header('Location: login.php');
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

        <form action="" method="post"  class="form-horizontal">
            <fieldset>

            </fieldset>
        </form>


        <div class="container">
            <div class="row">
                <div class="span3 ">
                    <button class="btn btn-mini btn-danger ">Mini button</button>
                    <img class="img-responsive" src="http://2.bp.blogspot.com/-H6MAoWN-UIE/TuRwLbHRSWI/AAAAAAAABBk/89iiEulVsyg/s400/Free%2BNature%2BPhoto.jpg" />
                </div>
                <div class="span3 ">
                    <button class="btn btn-mini btn-danger">Mini button</button>
                    <img class="img-responsive" src="http://2.bp.blogspot.com/-H6MAoWN-UIE/TuRwLbHRSWI/AAAAAAAABBk/89iiEulVsyg/s400/Free%2BNature%2BPhoto.jpg" />
                </div>
                <div class="span3 ">
                    <button class="btn btn-mini btn-danger">Mini button</button>
                    <img class="img-responsive" src="http://2.bp.blogspot.com/-H6MAoWN-UIE/TuRwLbHRSWI/AAAAAAAABBk/89iiEulVsyg/s400/Free%2BNature%2BPhoto.jpg" />
                </div>
                <div class="span3 ">
                    <button class="btn btn-mini btn-danger">Mini button</button>
                    <img class="img-responsive" src="http://2.bp.blogspot.com/-H6MAoWN-UIE/TuRwLbHRSWI/AAAAAAAABBk/89iiEulVsyg/s400/Free%2BNature%2BPhoto.jpg" />
                </div>
                <div class="span3 ">
                    <button class="btn btn-mini btn-danger">Mini button</button>
                    <img class="img-responsive" src="http://2.bp.blogspot.com/-H6MAoWN-UIE/TuRwLbHRSWI/AAAAAAAABBk/89iiEulVsyg/s400/Free%2BNature%2BPhoto.jpg" />
                </div>
                <div class="span3 ">
                    <button class="btn btn-mini btn-danger">Mini button</button>
                    <img class="img-responsive" src="http://2.bp.blogspot.com/-H6MAoWN-UIE/TuRwLbHRSWI/AAAAAAAABBk/89iiEulVsyg/s400/Free%2BNature%2BPhoto.jpg" />
                </div>
                <div class="span3 ">
                    <button class="btn btn-mini btn-danger">Mini button</button>
                    <img class="img-responsive" src="http://2.bp.blogspot.com/-H6MAoWN-UIE/TuRwLbHRSWI/AAAAAAAABBk/89iiEulVsyg/s400/Free%2BNature%2BPhoto.jpg" />
                </div>



            </div>
        </div>
    </div>


<?php
require_once('common/footer.php');
?>