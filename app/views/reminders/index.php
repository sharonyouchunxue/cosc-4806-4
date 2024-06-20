<?php require_once 'app/views/templates/header.php'; ?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Reminders</h1>
            </div>
        </div>
    </div>

    <!-- Create Reminder Form -->
    <div class="row">
        <div class="col-lg-12">
            <h2>Create Reminder</h2>
            <form method="POST" action="/reminders/create">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <!-- List of Reminders -->
    <div class="row">
        <div class="col-lg-12">
            <h2>List of Reminders</h2>
            <?php foreach ($data['reminders'] as $reminder): ?>
                <div class="reminder-item">
                    <p><?php echo htmlspecialchars($reminder['subject']); ?></p>
                    <!-- Update Form Inline -->
                    <form method="POST" action="/reminders/update/<?php echo $reminder['id']; ?>" style="display: inline;">
                        <input type="text" name="subject" value="<?php echo htmlspecialchars($reminder['subject']); ?>" required>
                        <label for="completed-<?php echo $reminder['id']; ?>">Completed</label>
                        <input type="checkbox" id="completed-<?php echo $reminder['id']; ?>" name="completed" value="1" <?php echo $reminder['completed'] ? 'checked' : ''; ?>>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                    <!-- Delete Form Inline -->
                    <form method="POST" action="/reminders/delete/<?php echo $reminder['id']; ?>" style="display: inline;">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require_once 'app/views/templates/footer.php'; ?>
