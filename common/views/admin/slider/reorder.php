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

    <form action="" method="post">
        <div class="box-content">
            <ul  id="sortable" class="dashboard-list">
                <?php foreach($slides as $slide): ?>
                    <li>
                        <a href="#">
                            <img class="avatar" alt="<?php echo $slide->getTitle(); ?>" src="uploads/tours/<?php echo $slide->getImage(); ?>">
                        </a>
                        <strong>Title:</strong> <a href="#"><?php echo $slide->getTitle(); ?></a><br>
                        <strong>ID</strong> <?php echo $slide->getId(); ?> <br>
                        <strong>Status:</strong> <span class="label label-success">Active</span>
                        <input type="hidden" name="slides[]" value="<?php echo $slide->getId(); ?>" />
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <input type="submit" class="btn btn-large btn-success" value="Reorder" name="reorder" />
    </form>
</div><!--/.fluid-container-->

<?php require_once __DIR__.'/../include/footer.php'; ?>
<script>
    $(function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    });
</script>
