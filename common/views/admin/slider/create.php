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
<form action="" method="post"   class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <div class="control-group <?php echo (array_key_exists('title', $errors))? 'error' : ''; ?>">
            <label class="control-label" for="inputError">title</label>
            <div class="controls">
                <input type="text" id="inputError" name="title" value="">
                <?php if (array_key_exists('title', $errors)): ?>
                    <span class="help-inline"><?php echo $errors['title']; ?></span>
                <?php  endif; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fileInput">File input</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileInput" name="image" type="file">

            </div>
        </div>
        <div class="form-actions">
            <input type="submit" name="createSlide" value="Add Slide" class="btn btn-primary"/>
        </div>
    </fieldset>
</form>
</div>

<?php require_once __DIR__.'/../include/footer.php'; ?>
