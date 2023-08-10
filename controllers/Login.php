<?php
include_once 'Database.php';
class Login
{
    //AUTHENTICATE User
    public function authenticate($admin_user = null, $admin_pass = null)
    {

        $db = new Database();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $array = array(
            'admin_user' => $admin_user,
            'admin_pass' => md5($admin_pass),
        );

        $stmt = $db->queryWithParamsArray("SELECT * from admin WHERE admin_user=:admin_user AND
			admin_pass=:admin_pass", $array);
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $_SESSION['user_name'] = $row->admin_user;
            $_SESSION['admin_id'] = $row->admin_id;

            return true;
        } else {
            return false;
        }

    }

}
