<?php
include_once 'Database.php';
class Task
{

    public function insert($name, $description, $status, $project_id)
    {
        $db = new Database();

        $array = array(
            'project_id' => $project_id,
            'name' => $name,
            'description' => $description,
            'created_on' => date('Y-m-d'),
            'status' => $status,
        );

        $stmt = $db->queryWithParamsArray("insert into tasks(project_id,name, description, status,created_on)  values(:project_id,:name,:description, :status, :created_on)", $array);
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

        $stmt = $db->queryWithParamsArray("UPDATE tasks set status=:status WHERE id=:id ", $array);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
    public function edit($id, $name, $description, $status, $project_id)
    {
        $db = new Database();

        $array = array(
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'project_id' => $project_id,
            'status' => $status,
        );

        $stmt = $db->queryWithParamsArray("UPDATE tasks set name=:name, project_id=:project_id, description=:description, status=:status WHERE id=:id ", $array);
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

        $result = $db->queryWithParamsArray("DELETE FROM tasks where id=:id", $array);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    public function getTaskDetail($id)
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(
            'id' => $id,
        );

        $stmt = $db->queryWithParamsArray("select * from tasks where id=:id ", $array);
        if ($stmt) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    public function getAllTasks()
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(

        );

        $result = $db->queryWithParamsArray("SELECT * from tasks", $array);
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        } else {
            return false;
        }

    }

    public function getAllTasksForProject($project_id)
    {
        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(
            'project_id'=> $project_id
        );

        $result = $db->queryWithParamsArray("SELECT * from tasks where project_id=:project_id", $array);
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
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

        $result = $db->queryWithParamsArray("SELECT * from tasks", $array);
        if ($result->rowCount() > 0) {
            return $result->rowCount();
        } else {
            return 0;
        }
    }

}
