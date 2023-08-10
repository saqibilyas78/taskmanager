<?php
session_start();
include_once '../controllers/Project.php';

$name = $_POST['name'];
$description = $_POST['description'];
$image = $_FILES['image']['name'];

if (isset($_POST['status'])) {
    $status = "Y";
} else {
    $status = "N";
}

$project = new Project();
if (!$project->isDuplicate($name)) {

    if ($_FILES["image"]["size"] > 0) {
        $target_path = "../images/projects/";

        $target_path = $target_path . basename($_FILES['image']['name']);
        $target_path;

        move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

    } else {
        $image = "";
    }

    $insert = $project->insert($name, $description, $image, $status);
    if ($insert) {
        header("Location: ../manage_projects.php?action=success");
    } else {
        header("Location: ../manage_projects.php?action=failed");
    }
} else {
    header("Location: ../manage_projects.php?action=duplicate");
}
