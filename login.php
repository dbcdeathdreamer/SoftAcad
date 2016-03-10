<?php require_once 'header.php'; ?>

<?php require_once 'nav.php'; ?>
<!-- Header Carousel -->

<?php
$errors = array();
if (isset($_POST['username']) && isset($_POST['password']) && strlen($_POST['username']) > 3 && strlen($_POST['password']) >3) {
    $password = sha1($_POST['password']);

    $clientsCollection = new ClientsCollection();
    $username = htmlspecialchars(trim($_POST['username']));
    $where = array('username' => $username);
    $result = $clientsCollection->getAll($where);
    if ($result != null  && $result[0]->getPassword() == $password) {
        $_SESSION['client'] = $result[0];
        header('Location: index.php');
    } else {
        $errors['login'] = 'Wrong credentials';
    }

}

?>


<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Login
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index1.php">Home</a>
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

                        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>

                        <input type="submit" class="btn btn-lg btn-primary btn-block"  name="submit" value="Login">Login</input>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->



<?php require_once 'footer.php'; ?>
