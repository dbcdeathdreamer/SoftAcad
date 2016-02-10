<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

require_once('common/sidebar.php');

?>

<?php
$insertInfo = array(
    'username' => '',
    'password' => '',
    'email'    => '',
    'description' => ''
);

if($_POST['createUser']) {

    $insertInfo = array(
        'username' => $_POST['username'],
        'password' => sha1($_POST['password']),
        'email'    => $_POST['email'],
        'description' => $_POST['description']
    );

    createNewUser($insertInfo);
} ?>
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


        <form action="" method="post">


            <div class="control-group error">
                <label class="control-label" for="inputError">Input with error</label>
                <div class="controls">
                    <input type="text" id="inputError" name="username">
                    <span class="help-inline">Please correct the error</span>
                </div>
            </div>
            <div class="control-group error">
                <label class="control-label" for="inputError">Input with error</label>
                <div class="controls">
                    <input type="password" id="inputError" name="password">
                    <span class="help-inline">Please correct the error</span>
                </div>
            </div>
            <div class="control-group error">
                <label class="control-label" for="inputError">Input with error</label>
                <div class="controls">
                    <input type="text" id="inputError" name="email">
                    <span class="help-inline">Please correct the error</span>
                </div>
            </div>
            <div class="control-group error">
                <label class="control-label" for="inputError">Input with error</label>
                <div class="controls">
                    <input type="text" id="inputError" name="description">
                    <span class="help-inline">Please correct the error</span>
                </div>
            </div>
            <input type="submit" name="createUser" />
        </form>




    </div>


<?php
require_once('common/footer.php');
?>