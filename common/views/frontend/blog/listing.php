<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/nav.php'; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Blog Home Two
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a>
                </li>
                <li class="active">Blog Home Two</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <?php foreach($blogs as $blog): ?>
        <!-- Blog Post Row -->
        <div class="row">
            <div class="col-md-1 text-center">
                <p><i class="fa fa-camera fa-4x"></i>
                </p>
                <p>June 17, 2014</p>
            </div>
            <div class="col-md-5">
                <a href="index.php?c=blog&m=show&id=<?php echo $blog->getId(); ?>">
                <img class="img-responsive img-hover" src="admin/uploads/tours/<?php echo $blog->getImage(); ?>" alt="">
                </a>
            </div>
            <div class="col-md-6">
                <h3>
                    <a href="index.php?c=blog&m=show&id=<?php echo $blog->getId(); ?>"><?php echo $blog->getTitle(); ?></a>
                </h3>
                <p><?php echo $blog->getDescription(); ?></p>
                 <a class="btn btn-primary" href="index.php?c=blog&m=show&id=<?php echo $blog->getId(); ?>">Read More <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <!-- /.row -->
    <?php endforeach; ?>
    <hr>


    <hr>



    <hr>

    <!-- Pager -->
    <div class="row">
       <?php echo $pagination->create(); ?>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>

</div>



<?php require_once __DIR__.'/../include/footer.php'; ?>

