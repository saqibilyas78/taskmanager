<?php
include_once '../controllers/Project.php';
include_once '../controllers/Task.php';

$id = $_POST['id'];
$value = $_POST['value'];
$Row = $_POST['tableRow'];
$action = $_POST['action'];

switch ($action) {

    case 'btn-project-update':
        $projectObj = new Project();

        $projectObj->update($id, $value);
        if ($value == "N") {
            echo '<a href="javascript:void(0);" title="Enable" row="' . $id . '" value="Y" countTableRow="' . $Row . '" ><span class="label label-danger">Disable</span></a>';
        } else if ($value == "Y") {
            echo '<a href="javascript:void(0);" title="Disable" row="' . $id . '" value="N" countTableRow="' . $Row . '" ><span class="label label-success">Enable</span></a>';
        }
        break;
        case 'update-task':
        $taskObj = new Task();

        $taskObj->update($id, $value);
        break;

}
