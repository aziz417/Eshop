<?php
$filePath = realpath(dirname(__FILE__));
include_once($filePath.'/../lib/Database.php');
include_once($filePath.'/../helpers/Format.php');


class product{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data,$file){
        $productName = $this->fm->validation($data['productName']);
        $catId       = $this->fm->validation($data['catId']);
        $brandId     = $this->fm->validation($data['brandId']);
        $body        = $this->fm->validation($data['body']);
        $price       = $this->fm->validation($data['price']);
        $type        = $this->fm->validation($data['type']);

        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        $body = mysqli_real_escape_string($this->db->link, $body);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = mysqli_real_escape_string($this->db->link, $type);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $file_name == "" || $price == "" || $type == "" ){
            $msg = "<span class='error'> Fild must not be empty</span>";
            return $msg;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$productName', '$catId', '$brandId', '$body','$price','$uploaded_image','$type')";
            $insert_row = $this->db->insert($query);
            if($insert_row){
                $msg = "<span class='success'> Product Inserted Successfully</span>";
                return $msg;
            }else{
                $msg = "<span class='error'> Product not Inserted</span>";
                return $msg;
            }
        }
    }

    public function selectProduct(){          /*  inner join with product table category table and brand table */
   /*     $query = "SELECT tbl_product.*, tbl_catagory.categoryName, tbl_brand.brandName
        FROM tbl_product
        INNER JOIN tbl_catagory
        ON tbl_product.catId = tbl_catagory.catagoryId
        INNER JOIN tbl_brand
        ON tbl_product.brandId = tbl_brand.brandId
        ORDER BY tbl_product.productId DESC";*/
        $query = "SELECT p.*, c.categoryName, b.brandName    /*Alises join into product table category table and brand table*/
        FROM tbl_product as p, tbl_catagory as c, tbl_brand as b
        WHERE p.catId = c.catagoryId AND p.brandId = b.brandId
        ORDER BY  p.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function editProduct($id){
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateProduct($data,$file,$id)
    {
        $productName = $this->fm->validation($data['productName']);
        $catId       = $this->fm->validation($data['catId']);
        $brandId     = $this->fm->validation($data['brandId']);
        $body        = $this->fm->validation($data['body']);
        $price       = $this->fm->validation($data['price']);
        $type        = $this->fm->validation($data['type']);
        $id          = $this->fm->validation($id);


        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext       = strtolower(end($div));
        $unique_image   = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($file_name)) {
            if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $id == '') {
                $msg = "<span class='error'> Fild must not be empty</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_product SET
                        productName = '$productName',
                        catId       = '$catId',
                        brandId     = '$brandId',
                        body        = '$body',
                        price       = '$price',
                        type        = '$type'
                        WHERE productId = '$id'";

                $update_row = $this->db->update($query);
                if ($update_row) {
                    $msg = "<span class='success'>Brand updated successfully! </span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Brand do not updated! </span>";
                    return $msg;
                }
            }
        }else{
            if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == "" || $id == '') {
                    $msg = "<span class='error'> Fild must not be empty</span>";
                    return $msg;
            } else {
                $q_imgDlt= "SELECT * FROM tbl_product WHERE productId = '$id'";
                $result = $this->db->select($q_imgDlt);
                if($result) {
                    while ($dltImg = $result->fetch_assoc()) {
                        unlink($dltImg['image']);
                    }
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET
                        productName = '$productName',
                        catId       = '$catId',
                        brandId     = '$brandId',
                        body        = '$body',
                        price       = '$price',
                        type        = '$type',
                        image       = '$uploaded_image'
                        WHERE productId = '$id'";

                $update_row = $this->db->update($query);
                if ($update_row) {
                    $msg = "<span class='success'>Brand updated successfully! </span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Brand do not updated! </span>";
                    return $msg;
                }
            }
        }
    }

    public function dltProduct($dltId){
        $query = "SELECT * FROM tbl_product WHERE productId = '$dltId'";
        $result = $this->db->select($query);
        if($result) {
            while ($dltImg = $result->fetch_assoc()){
                unlink($dltImg['image']);
            }
        }

        $getproduct = "DELETE FROM  tbl_product WHERE productId = '$dltId'";
        $result = $this->db->delete($getproduct);
        if($result){
            $msg = "<span class='success'> Product delete successfully!</span>";
            return $msg;
        }else{
            $msg = "<span class='error'> Product not deleted!</span>";
            return $msg;
        }
    }

    public function fontSelectProduct(){
        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
     public function newFontSelectProduct(){
            $query = "SELECT * FROM tbl_product ORDER BY productId ASC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }


    public function productDetails($id){
        /*$query = "SELECT tbl_product.*, tbl_catagory.categoryName, tbl_brand.brandName FROM tbl_product
        INNER JOIN tbl_catagory
        ON tbl_product.catId = tbl_catagory.catagoryId
        INNER JOIN tbl_brand
        ON tbl_product.brandIl = tbl_brand.brandId AND tbl_product.productId = '$id'";

        $result = $this->db->select($query);
        return $result;*/

        $query = "SELECT p.*, c.categoryName, b.brandName    /*Alises join into product table category table and brand table*/
        FROM tbl_product as p, tbl_catagory as c, tbl_brand as b
        WHERE p.catId = c.catagoryId AND p.brandId = b.brandId AND p.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productGetByBrand(){
        $query = "SELECT p.*,b.brandName FROM tbl_product as p, tbl_brand as b WHERE p.brandId = b.brandId ORDER BY productId ASC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function productGetByCategory($id){
        $query = "SELECT tbl_product.*, tbl_catagory.categoryName FROM tbl_product INNER JOIN tbl_catagory ON tbl_product.catId = tbl_catagory.catagoryId AND tbl_catagory.catagoryId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productGetByCategoryName($id){
        $query = "SELECT tbl_product.*, tbl_catagory.categoryName FROM tbl_product INNER JOIN tbl_catagory ON tbl_product.catId = tbl_catagory.catagoryId AND tbl_catagory.catagoryId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>