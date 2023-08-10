<?php
session_start();
include_once '../controllers/Task.php';

$name = $_POST['name'];
$project_id = $_POST['project_id'];
$status = $_POST['status'];
$description = $_POST['description'];

$task = new Task();

$insert = $task->insert($name, $description, $status, $project_id);
if ($insert) {
    header("Location: ../tasks.php?action=success");
} else {
    header("Location: ../tasks.php?action=failed");
}
