<?php

// include header
include $_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php';

// instantiate support class
$support = new \SimpleLance\Support($db);

    if (isset($_POST['submit'])) {

    $subject = trim($_POST["subject"]);
    $content = trim($_POST["content"]);
    $priority = trim($_POST["priority"]);

    if (isset($_POST['owner']) && !empty($_POST['owner'])) {
        $owner = trim($_POST['owner']);
    } else {
        $owner = $_SESSION['id'];
    }

    if (empty($subject) || empty($content) || empty($priority)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE) {
        $support->new_ticket($subject, $content, $priority, $owner);
        if ($_SESSION['access_level'] == 1) {
            header('Location: /support/?addsuccess');
        } else {
            header('Location: /support/?owner='.$_SESSION['id'].'&addsuccess');
        }

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
    <form class="well span6" role="form" action='' method='post'>
        <div class="row">
            <div class="form-group col-lg-12">
                <label for="subject">Subject</label><br>
                <input type="text" name="subject" id="subject" value="">
            </div>
            <div class="form-group col-lg-12">
                <label for="content">Ticket Content</label><br>
                <textarea rows="5" cols="50" name="content" id="content"></textarea>
            </div>
            <div class="form-group col-lg-12">
                <label for="priority">Priority</label><br>
                <select name="priority" id="priority">
                    <option value=""></option>
                    <?php foreach ($support->get_priorities() as $p) {
                        echo "<option value='".$p['id']."'>".$p['priority']."</option>";
                    } ?>
                </select>
            </div>
            <?php
            if ($_SESSION['access_level'] == '1') {
                $user = $users->get_users(); ?>
                <div class="form-group col-lg-12">
                    <label for="owner">Owner</label><br>
                    <select name="owner" id="owner">
                        <option value=""></option>
                        <?php foreach ($user as $u) {
                            echo "<option value='".$u['id']."'>".$u['first_name'].' '.$u['last_name']."</option>";
                        } ?>
                    </select>
                </div>
            <?php } ?>
            <div class="form-group col-lg-6">
                <button class="btn btn-primary pull-right" name="submit" type="submit">Submit Ticket</button>
            </div>
        </div>
    </form>
<?php
// include footer
include ABS_PATH . '/includes/template/footer.php';
?>
