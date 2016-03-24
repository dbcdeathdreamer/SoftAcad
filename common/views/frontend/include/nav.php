<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../../../../index1.php">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> <span id="shoppingNumber"><?php echo count($_SESSION['basket']) ?></span> - Items<span class="caret"></span></a>
                    <ul id="shoppingBasket" class="dropdown-menu dropdown-cart" role="menu">
                       
                       <?php if(count($_SESSION['basket']) > 0 ): ?>
                           <?php foreach($_SESSION['basket'] as $element): ?>
                                <li>
                                      <span class="item">
                                        <span class="item-left">
                                            <img src="http://lorempixel.com/50/50/" alt="" />
                                            <span class="item-info">
                                                <span><?php echo $element['id'];  ?></span>
                                                <span><?php echo $element['quantity']; ?></span>
                                            </span>
                                        </span>
                                        <span class="item-right">
                                            <button class="btn btn-xs btn-danger pull-right">x</button>
                                        </span>
                                    </span>
                                </li>
                               <?php endforeach; ?>
                        <?php endif; ?>
                        <li class="divider"></li>
                        <li><a class="text-center" href="">View Cart</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Tours Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php 
                        $categoryCollection = new CategoryCollection();
                        $categories = $categoryCollection->getAll();
                        ?>
                        <li>
                            <a href="index.php?c=tours&m=index&id=0">All Categories</a>
                        </li>
                        <?php foreach($categories as $category): ?>
                        <li>
                            <a href="index.php?c=tours&m=index&id=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="index.php?c=blog&m=index">Blog</a>
                </li>
                <li>
                    <a href="../../../../about.php">About</a>
                </li>
                <li>
                    <a href="../../../../login.php">Login</a>
                </li>
                <li>
                    <a href="../../../../logout.php">Logout</a>
                </li>

            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>