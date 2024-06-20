<?php

require_once 'app/models/Reminder.php';

class Reminders extends Controller {

    public function index() {
        $reminder = $this->model('Reminder');
        $list_of_reminders = $reminder->get_all_reminders();
        $this->view('reminders/index', ['reminders' => $list_of_reminders]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start(); 
            $user_id = $_SESSION['user_id']; 
            $subject = $_POST['subject'];
            $reminder = $this->model('Reminder');
            $reminder->create_reminder($user_id, $subject);
            header('Location: /reminders');
            exit;
        } else {
            $this->view('reminders/create/index');
            exit;
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = isset($_POST['subject']) ? $_POST['subject'] : null;
            $completed = isset($_POST['completed']) ? (bool)$_POST['completed'] : null;
            $deleted = isset($_POST['deleted']) ? (bool)$_POST['deleted'] : null;

            $update_data = [];

            if ($subject !== null) {
                $update_data['subject'] = $subject;
            }
            if ($completed !== null) {
                $update_data['completed'] = $completed;
            }
            if ($deleted !== null) {
                $update_data['deleted'] = $deleted;
            }

            if (!empty($update_data)) {
                $reminder = $this->model('Reminder');
                $reminder->update_reminder($id, $update_data);
            }

            header('Location: /reminders');
            exit;
        } else {
            $reminder = $this->model('Reminder');
            $reminder_info = $reminder->get_reminder($id);
            $this->view('reminders/update', ['reminder' => $reminder_info]);
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder');
            $reminder->delete_reminder($id);  
            header('Location: /reminders');
            exit;
        }
    }
}
?>
