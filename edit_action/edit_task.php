<?php
session_start();
include_once '../controllers/Task.php';

$id = $_POST['id'];
$project_id = $_POST['project_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$status = $_POST['status'];

$task = new Task();

$edit = $task->edit($id, $name, $description, $status, $project_id);
if ($edit) {
    header("Location: ../tasks.php?action=update_success");
} else {
    header("Location: ../tasks.php?action=update_failed");
}
