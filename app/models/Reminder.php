<?php

class Reminder {

    public function __construct() {
    }
    //Function to read and view for single reminder by id
    public function get_reminder($id){
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM reminders WHERE id = :id AND deteled = FALSE;");
        $statement->excute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    //Function to read and view all reminders
    public function get_all_reminders () {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM reminders WHERE deleted = FALSE;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    //Function to allow user to create reminder after login
    public function creare_reminder ($user_id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO reminders (user_id, subject, created_at) VALUES (:user_id, :subject;");
        $statement->execute([':user_id' => $user_id, ':subject' => $subject]);
        return $db->lastInsertId();
    }

    //Function to allow user to update reminder
    public function update_reminder ($reminder_id, $subject = null, $completed = null, $deleted = null) {
        $db = db_connect();
        //do update statement
        $query = "Update reminders ";
        $param = [];

        if($subject != null){
            $query .= "subject = :subject, ";
            $param[':subject'] = $subject;   
        }

        if($completed != null){
            $query .= "completed = :completed, ";
            $param[':completed'] = $completed;
        }

        if($deleted != null){
            $query .= "deleted = :deleted, ";
            $param[':deleted'] = $deleted;
        }

        //To remove and trailling the space or comma
        $query = rtrim($query, ', ') . " WHERE id = :id;";
        $param[':id'] = $reminder_id; 

        // Ensure there are fields to update
        if (count($param) > 1) {
            $statement = $db->prepare($query);
            $statement->execute($param);
        } else {
            throw new Exception("No fields to update.");
        }
    }
    // Function to delete a reminder
    public function delete_reminder($reminder_id) {
        $this->update_reminder($reminder_id, null, null, true);
    }
}
?>
