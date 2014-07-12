<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate projects class
$tickets = new Tickets($db);
// check if valid ticket requested, if not return to ticket list
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ticket = $tickets->get_ticket($_GET['id']);
    if ($ticket == "Error" || $ticket['owner'] != $_SESSION['id'] && $_SESSION['access_level'] != '1') {
        header("Location: /support/");
        exit();
    }
} else {
    header("Location: /support/");
    exit();
}
// submit ticket reply to database
if (isset($_POST['submit'])) {

    $content = trim($_POST["content"]);
    $status = trim($_POST['status']);

    if (empty($content) || empty($status)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE){
        $tickets->update_ticket($ticket['id'], $content, $_SESSION['id'], $status);
        header('Location: /support/?updatesuccess');
        exit();
    }
}
?>
<!-- html -->
<br><br>
    <?php
    // display any errors
    if (!empty($errors)) {
        echo '<p>' . implode('</p><p>', $errors) . '</p>';
    }
    ?>
<div class="row">
    <div class="form-group col-lg-12">
        <b>Ticket Subject</b><br>
        <?php echo htmlentities($ticket['subject']); ?>
    </div>
    <div class="form-group col-lg-12">
        <b>Owner</b><br>
        <?php echo $users->get_user($ticket['owner'])['first_name'].' '.$users->get_user($ticket['owner'])['last_name']; ?>
    </div>
    <div class="form-group col-lg-12">
        <b>Status</b><br>
        <?php echo $tickets->get_status($ticket['status']); ?>
    </div>
    <div class="form-group col-lg-12">
        <b>Last Update</b><br>
        <?php echo date('d/m/Y H:m', strtotime($ticket['last_reply_date'])); ?>
    </div>
    <div class="form-group col-lg-12">
        <b>Ticket Content</b><br>
        <?php echo htmlentities($ticket['content']); ?>
    </div>
</div>
<?php foreach ($tickets->get_ticket_replies($ticket['id']) as $r) { ?>
    <div class="form-group col-lg-12">
        <em>Reply by</em> <b><?php echo $users->get_user($r['user_id'])['first_name'].' '.$users->get_user($r['user_id'])['last_name']; ?></b>
        <em>on</em> <b><?php echo date('d/m/Y', strtotime($r['replied_on'])); ?></b> <em>at</em> <b><?php echo date('H:m', strtotime($r['replied_on'])); ?></b>
        <br>
        <?php echo htmlentities($r['content']); ?>
    </div>
<?php } ?>

    <div class="form-group col-lg-6">
        <b>New Reply</b><br>
        <form class="well span6" role="form" action='' method='post'>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="content">Reply Content</label><br>
                    <textarea rows="5" cols="50" name="content" id="content"></textarea>
                </div>
                <div class="form-group col-lg-12">
                    <label for="status">Status</label><br>
                    <select name="status" id="status">
                        <?php
                        foreach ($tickets->get_statuses() as $status){
                            $status_selected = $tickets->get_status($ticket['status']);
                            if ($status['id'] === $ticket['status']) {
                                $selected = "selected='selected'";
                            } else {
                                $selected = null;
                            }
                            echo "<option value='".$status['id']."' ".$selected.">".$status['status']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <button class="btn btn-primary pull-right" name="submit" type="submit">Submit Reply</button>
                </div>
            </div>
        </form>
    </div>
<!-- /html -->

<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>