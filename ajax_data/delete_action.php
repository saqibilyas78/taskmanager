<?php
session_start();
include_once '../controllers/Project.php';
include_once '../controllers/Task.php';

$id = $_POST['id'];
$action = $_POST['action'];

switch ($action) {

    case 'btn-project-delete':
        $projectObj = new Project();
        $data = $projectObj->getProjectDetail($id);
        $res = $projectObj->delete($id);
        if ($res) {
            $path = "../images/projects/" . $data->image;
            unlink($path);
        }
        break;
    case 'btn-task-delete':
        $taskObj = new Task();
        $data = $taskObj->getTaskDetail($id);
        $res = $taskObj->delete($id);
        break;
}
