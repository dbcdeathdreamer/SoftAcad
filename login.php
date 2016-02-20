<?php require_once 'header.php'; ?>

<?php require_once 'nav.php'; ?>
<!-- Header Carousel -->

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Login
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a>
                </li>
                <li class="active">Login</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Intro Content -->
    <div class="row">
        <div class="col-md-12">
            <div class = "container">
                <div class="wrapper">
                    <form action="" method="post" name="Login_Form" class="form-signin">
                        <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                        <hr class="colorgraph"><br>

                        <input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
                        <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>

                        <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->



<?php require_once 'footer.php'; ?>
