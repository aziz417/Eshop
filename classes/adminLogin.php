<?php
    $filePath = realpath(dirname(__FILE__));
    include_once($filePath.'/../lib/Session.php');
    Session::checkLogin();
    include_once($filePath.'/../lib/Database.php');
    include_once($filePath.'/../helpers/Format.php');
?>
<?php
/*adminLogin class*/
class adminLogin{
    private $db;
    private $fm;
    public function __construct()
    {
       $this->db = new Database();
       $this->fm = new Format();
    }

    public function adminLogin($adminUser,$adminPass){

        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);


        $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link,$adminPass);

        if(empty($adminUser) || empty($adminPass)){
            $loginmsg = "Username or Password must not be empty!!";
            return $loginmsg;
        }else{
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
            $result = $this->db->select($query);

            if($result != false){

                $value = $result->fetch_assoc();
                Session::set("adminLogin",true);
                Session::set("adminID", $value['admninID']);
                Session::set("adminUser", $value['adminUser']);
                Session::set("adminName", $value['adminName']);
                header("Location:dashbord.php");
            }else{
                $loginmsg = "Username or Password not match!!";
                return $loginmsg;
            }
        }
    }
}
