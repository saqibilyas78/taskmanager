<?php
include_once 'Database.php';
class Project
{

    public function insert($name, $description, $image, $status)
    {
        $db = new Database();

        $array = array(
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'created_on' => date('Y-m-d'),
            'status' => $status,
        );

        $stmt = $db->queryWithParamsArray("insert into projects(name, description,image, status,created_on)  values(:name,:description, :image, :status, :created_on)", $array);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $status)
    {
        $db = new Database();

        $array = array(
            'id' => $id,
            'status' => $status,
        );

        $stmt = $db->queryWithParamsArray("UPDATE projects set status=:status WHERE id=:id ", $array);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
    public function edit($id, $name, $description, $image, $status)
    {
        $db = new Database();

        $array = array(
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'status' => $status,
        );

        $stmt = $db->queryWithParamsArray("UPDATE projects set name=:name, image=:image, description=:description, status=:status WHERE id=:id ", $array);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(
            'id' => $id,
        );

        $result = $db->queryWithParamsArray("DELETE FROM projects where id=:id", $array);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    public function getProjectDetail($id)
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(
            'id' => $id,
        );

        $stmt = $db->queryWithParamsArray("select * from projects where id=:id ", $array);
        if ($stmt) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    public function getAllProjects()
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(
            'status' => "Y",
        );

        $result = $db->queryWithParamsArray("SELECT * from projects where status=:status", $array);
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        } else {
            return false;
        }

    }

    public function isDuplicate($name)
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(
            'name' => $name,
        );

        $result = $db->queryWithParamsArray("SELECT * from projects where name=:name", $array);
        if ($result->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public static function get_total_all_records()
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(

        );

        $result = $db->queryWithParamsArray("SELECT * from projects", $array);
        if ($result->rowCount() > 0) {
            return $result->rowCount();
        } else {
            return 0;
        }
    }

}
