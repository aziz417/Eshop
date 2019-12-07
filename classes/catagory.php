<?php
$filePath = realpath(dirname(__FILE__));
include_once($filePath.'/../lib/Database.php');
include_once($filePath.'/../helpers/Format.php');

    class catagory{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function catagoryAdd($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            if(empty($catName)){
                $msg = "<span class='error'>Category must not be empty! </span>";
                return $msg;
            }else{
                $query = "INSERT INTO tbl_catagory(categoryName)  VALUES('$catName')";
                $catInsert = $this->db->insert($query);
                if($catInsert){
                    $msg = "<span class='success'>Category inserted successfully! </span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Category not inserted! </span>";
                    return $msg;
                }
            }
        }

        public function catagoryList(){
            $getcat = "SELECT * FROM  tbl_catagory ORDER BY catagoryId DESC";
            $result = $this->db->select($getcat);
            return $result;
        }

        public function catagoryEdit($id){
            $query = "SELECT * FROM tbl_catagory WHERE catagoryId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function updateCat($editCatName, $id){
            $catName = $this->fm->validation($editCatName);
            $id      = $this->fm->validation($id);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            $id = mysqli_real_escape_string($this->db->link,$id);

            if(empty($catName)){
                $msg = "<span class='error'>Category must not be empty! </span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_catagory SET categoryName = '$catName' WHERE catagoryId = '$id'";
                $update_row = $this->db->update($query);
                if($update_row){
                    $msg = "<span class='success'>Category updated successfully! </span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Category do not updated! </span>";
                    return $msg;
                }
            }
        }

        public function catdlt($id){
            $getcat = "DELETE FROM  tbl_catagory WHERE 	catagoryId = '$id'";
            $result = $this->db->delete($getcat);
            if($result){
                $msg = "<span class='success'> Category delete successfully!</span>";
                return $msg;
            }else{
                $msg = "<span class='error'> Category not deleted!</span>";
                return $msg;
            }
        }
    }
?>