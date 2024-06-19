<?php require_once 'app/views/templates/header.php'; ?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Reminders</h1>
                <p><a href="/reminders/create">
                    Create a new reminder
                </a></p>
            </div>
        </div>
    </div>
    
<?php
    foreach ($data['reminders'] as $reminder) {
        echo "<p>" . $reminder['subject'] . ' <a href="/reminders/update"> update</a> <a href="/reminders/delete">delete</a></p>';
    }
    
?>


<?php require_once 'app/views/templates/footer.php'; ?>