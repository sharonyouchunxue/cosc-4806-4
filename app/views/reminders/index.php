<?php require_once 'app/views/templates/header.php'; ?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>List of Reminders</h1>
            </div>
        </div>
    </div>

    <!-- Display success message for reminder creation -->
    <?php
    session_start();
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']); // Clear the message after displaying it
    }
    ?>

    <!-- Reminders List Container -->
    <div class="row">
        <div class="col-lg-12 create-container">
            <?php foreach ($data['reminders'] as $reminder): ?>
                <div class="reminder-item">
                    <p><?php echo htmlspecialchars($reminder['subject']); ?></p>
                    <p><small>Created on: <?php echo htmlspecialchars($reminder['create_at']); ?></small></p>
                    <p><small>Reminder Time: <?php echo htmlspecialchars($reminder['reminder_time']); ?></small></p>
                    <!-- Update Form -->
                    <form method="POST" action="/reminders/update/<?php echo $reminder['id']; ?>" style="display: inline;">
                        <input type="text" name="subject" value="<?php echo htmlspecialchars($reminder['subject']); ?>" required>
                        <label for="date-<?php echo $reminder['id']; ?>">Date</label>
                        <input type="date" id="date-<?php echo $reminder['id']; ?>" name="date" value="<?php echo date('Y-m-d', strtotime($reminder['reminder_time'])); ?>" required>
                        <label for="time-<?php echo $reminder['id']; ?>">Time</label>
                        <input type="time" id="time-<?php echo $reminder['id']; ?>" name="time" value="<?php echo date('H:i', strtotime($reminder['reminder_time'])); ?>" required>
                        <label for="completed-<?php echo $reminder['id']; ?>">Completed</label>
                        <input type="checkbox" id="completed-<?php echo $reminder['id']; ?>" name="completed" value="1" <?php echo $reminder['completed'] ? 'checked' : ''; ?>>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                    <!-- Delete Form -->
                    <form method="POST" action="/reminders/delete/<?php echo $reminder['id']; ?>" style="display: inline;">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require_once 'app/views/templates/footer.php'; ?>
