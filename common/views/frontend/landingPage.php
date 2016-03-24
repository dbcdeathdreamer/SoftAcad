
<?php require_once __DIR__.'/include/header.php'; ?>
<?php require_once __DIR__.'/include/nav.php'; ?>

<!-- Header Carousel -->
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
            <div class="carousel-caption">
                <h2>Caption 1</h2>
            </div>
        </div>
        <div class="item">
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
            <div class="carousel-caption">
                <h2>Caption 2</h2>
            </div>
        </div>
        <div class="item">
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
            <div class="carousel-caption">
                <h2>Caption 3</h2>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>

<!-- Page Content -->
<div class="container">

    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Last Blog Posts
            </h1>
        </div>
        <div class="row">
            <?php foreach($lastBlogPosts as $lastPost): ?>
            <div class="col-md-4 img-portfolio">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-hover" src="admin/uploads/tours/<?php echo $lastPost->getImage(); ?>" alt="">
                </a>
                <h3>
                    <a href="portfolio-item.html"><?php echo $lastPost->getTitle(); ?></a>
                </h3>
                <p><?php echo $lastPost->getDescription(); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Tours
            </h1>
        </div>
        <div class="row">
            <?php foreach($randomTours as $randomTour): ?>
                <div class="col-md-4 img-portfolio">
                    <a href="portfolio-item.html">
                        <img class="img-responsive img-hover" src="admin/uploads/tours/<?php echo $randomTour->getImage(); ?>" alt="">
                    </a>
                    <h3>
                        <a href="portfolio-item.html"><?php echo $randomTour->getName(); ?></a>
                    </h3>
                    <p><?php echo $randomTour->getDescription(); ?></p>
                    <button data-id="<?php echo $randomTour->getId(); ?>" class="btn btn-danger basket"> Buy </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Section -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Portfolio Heading</h2>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="portfolio-item.html">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="portfolio-item.html">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="portfolio-item.html">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="portfolio-item.html">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="portfolio-item.html">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="portfolio-item.html">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
    </div>
    <!-- /.row -->

    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Modern Business Features</h2>
        </div>
        <div class="col-md-6">
            <p>The Modern Business template by Start Bootstrap includes:</p>
            <ul>
                <li><strong>Bootstrap v3.2.0</strong>
                </li>
                <li>jQuery v1.11.0</li>
                <li>Font Awesome v4.1.0</li>
                <li>Working PHP contact form with validation</li>
                <li>Unstyled page elements for easy customization</li>
                <li>17 HTML pages</li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
        </div>
        <div class="col-md-6">
            <img class="img-responsive" src="http://placehold.it/700x450" alt="">
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="well">
        <div class="row">
            <div class="col-md-8">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
            </div>
        </div>
    </div>

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
<!-- /.container -->

<?php require_once __DIR__.'/include/footer.php'; ?>
<script>
    $( document ).ready(function() {
        $(".basket").on('click', function(){
            var buttonId = $(this).data('id');
            var el = $(this);
            $.ajax({
                    method: "POST",
                    url: "index.php?c=dashboard&m=addToBasket",
                    data: { tourId: buttonId, quantity: 1 }
                })
                .done(function( msg ) {
                    var message =  JSON.parse(msg);
                    console.log(message.basketCount);
                    console.log( "Data Saved: " + msg );
                    $('#shoppingNumber').html(msg);

                    $("#shoppingBasket").prepend('<li>\
                        <span class="item">\
                        <span class="item-left">\
                        <img src="http://lorempixel.com/50/50/" alt="" />\
                        <span class="item-info">\
                        <span>Item name</span>\
                        <span>23$</span>\
                        </span>\
                        </span>\
                        <span class="item-right">\
                            <button class="btn btn-xs btn-danger pull-right">x</button>\
                            </span>\
                            </span>\
                            </li>');
                });
        });



    });

</script>

