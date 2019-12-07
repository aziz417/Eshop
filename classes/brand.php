<?php
$filePath = realpath(dirname(__FILE__));
include_once($filePath.'/../lib/Database.php');
include_once($filePath.'/../helpers/Format.php');

class brand{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandAdd($brandName){
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        if(empty($brandName)){
            $msg = "<span class='error'>Brand must not be empty! </span>";
            return $msg;
        }else{
            $query = "INSERT INTO tbl_brand(brandName)  VALUES('$brandName')";
            $brandInsert = $this->db->insert($query);
            if($brandInsert){
                $msg = "<span class='success'>Brand inserted successfully! </span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Brand not inserted! </span>";
                return $msg;
            }
        }
    }

    public function brandList(){
        $getbrand = "SELECT * FROM  tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select($getbrand);
        return $result;
    }

    public function editBrand($id){
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateBrand($brandName, $id){
        $brandName = $this->fm->validation($brandName);
        $id        = $this->fm->validation($id);
        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        $id = mysqli_real_escape_string($this->db->link,$id);

        if(empty($brandName)){
            $msg = "<span class='error'>Brand must not be empty! </span>";
            return $msg;
        }else{
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
            $update_row = $this->db->update($query);
            if($update_row){
                $msg = "<span class='success'>Brand updated successfully! </span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Brand do not updated! </span>";
                return $msg;
            }
        }
    }

    public function branddlt($id){
        $getbrand = "DELETE FROM  tbl_brand WHERE 	brandId = '$id'";
        $result = $this->db->delete($getbrand);
        if($result){
            $msg = "<span class='success'> Brand delete successfully!</span>";
            return $msg;
        }else{
            $msg = "<span class='error'> Brand not deleted!</span>";
            return $msg;
        }
    }
}
?>