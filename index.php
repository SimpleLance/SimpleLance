<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
?>
<div class="row">
    <div class="col-lg-12">
        <?php
        if (isset($_GET['editsuccess']) && empty($_GET['editsuccess'])) {
        echo '<br><br>User successfully updated.';
        }
        ?>
        <h1 class="page-header">Under Construction</h1>
        <p>Sorry for the mess about here, still getting things put together.</p>
    </div>
</div>
<?php
//include footer
include(ABS_PATH . '/includes/template/footer.php');
?>