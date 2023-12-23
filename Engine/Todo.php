<?php

class Todo
{

    private Database $db;
    private string $table_name = "todos";
    public int $todoId;
    public string $assignedTo;
    public string $taskDescription;
    public string $taskStatus;


    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function createTask()
    {
        if (empty($this->taskDescription)) {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Please enter a task."]);
            return;
        }

        $sql = "INSERT INTO " . $this->table_name . " (`assigned_to`, `task_description`) VALUES (:assignedTo, :taskDescription)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":assignedTo", $this->assignedTo);
        $stmt->bindParam(":taskDescription", $this->taskDescription);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Task added successfully."]);
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Failed to add task."]);
        }
    }

    public function editTask()
    {

        $sql = "UPDATE " . $this->table_name . " SET `assigned_to` = :assignedTo, `task_description` = :taskDescription, `updated_at` = :updateTime WHERE `todo_id` = :todoId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":assignedTo", $this->assignedTo);
        $stmt->bindParam(":taskDescription", $this->taskDescription);
        $time = time();
        $stmt->bindParam(":updateTime", $time);
        $stmt->bindParam(":todoId", $this->todoId);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Task updated successfully."]);
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Failed to update task."]);
        }
    }

    public function updateStatus()
    {

        $allowedStatus = ['Pending', 'Completed', 'In Progress'];
        if (!in_array($this->taskStatus, $allowedStatus)) {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Invalid status. Allowed values are 'Pending', 'Completed', 'In Progress'."]);
            return;
        }

        $sql = "UPDATE " . $this->table_name . " SET `task_status` = :newStatus WHERE `todo_id` = :todoId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":newStatus", $this->taskStatus);
        $stmt->bindParam(":todoId", $this->todoId);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Task status updated successfully."]);
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Failed to update task status."]);
        }
    }


    public function deleteTask()
    {

        $sql = "DELETE FROM " . $this->table_name . " WHERE `todo_id` = :todoId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":todoId", $this->todoId);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Task deleted successfully."]);
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Failed to delete task."]);
        }
    }




}