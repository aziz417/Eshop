<?php
$filePath = realpath(dirname(__FILE__));
include_once($filePath.'/../lib/Database.php');
include_once($filePath.'/../helpers/Format.php');


class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getProductInfo($quantity,$id){
        $quantity  = $this->fm->validation($quantity);
        $id        = $this->fm->validation($id);
        $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
        $id        = mysqli_real_escape_string($this->db->link,$id);
        $sessionId = session_id();

        $selectProductTblData = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $selectResult = $this->db->select($selectProductTblData);

        $result      = $selectResult->fetch_assoc();
        $productId   = $result['productId'];
        $productName = $result['productName'];
        $price       = $result['price'];
        $image       = $result['image'];

        $insertq = "INSERT INTO tbl_cart (sessionId,productId,productName,price,quantity,image) VALUES('$sessionId', '$productId', '$productName', '$price', '$quantity', '$image')";
        $inserted_row = $this->db->insert($insertq);
        if($inserted_row){
            header('Location:cart.php');
        }else{
            header('Location:error402.php');
        }
    }

    public function cartSelect(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCartQuantity($data){
        $cartId = $this->fm->validation($data['cartId']);
        $quantity = $this->fm->validation($data['quantity']);
        $cartId = mysqli_real_escape_string($this->db->link,$cartId);
        $quantity = mysqli_real_escape_string($this->db->link,$quantity);

        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId ='$cartId'";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span class='success'> Quantity updated successfully! </span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Quantity updated unsuccessfully! </span>";
            return $msg;
        }
    }

    public function cartDltId($cartId){
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span class='success'> Delete successfully! </span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Delete unsuccessfully! </span>";
            return $msg;
        }
    }

    public function dltCustomerCart(){
       $id = session_id();
       $query = "DELETE FROM tbl_cart WHERE sessionId = '$id'";
       $result = $this->db->delete($query);
       return $result;
    }

    public function cartCheck(){
        $sid = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }
}