<?php
session_start();
include_once '../controllers/Project.php';

$id = $_POST['id'];
$image_old = $_POST['image_old'];
$name = $_POST['name'];
$description = $_POST['description'];
$image = $_FILES['image']['name'];
$status = $_POST['status'];

$project = new Project();

if ($_FILES["image"]["size"] > 0) {
    $target_path = "../images/projects/";

    $target_path = $target_path . basename($_FILES['image']['name']);

    move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
} else {
    $image = $image_old;
}

$edit = $project->edit($id, $name, $description, $image, $status);
if ($edit) {
    header("Location: ../manage_projects.php?action=update_success");
} else {
    header("Location: ../manage_projects.php?action=update_failed");
}
