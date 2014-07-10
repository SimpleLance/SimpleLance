<?php

// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');

// instantiate support class
$tickets = new Tickets($db);

    if (isset($_POST['submit'])) {

    $subject = trim($_POST["subject"]);
    $content = trim($_POST["content"]);
    $priority = trim($_POST["priority"]);


    if (empty($subject) || empty($content) || empty($priority)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE){
        $tickets->new_ticket($subject, $content, $priority, $_SESSION['id']);
        header('Location: /support/?addsuccess');
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

// pull priorities
$priority = $tickets->get_priorities();
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
                    <?php foreach ($priority as $p) {
                        echo "<option value='".$p['id']."'>".$p['priority']."</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <button class="btn btn-primary pull-right" name="submit" type="submit">Submit Ticket</button>
            </div>
        </div>
    </form>
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>