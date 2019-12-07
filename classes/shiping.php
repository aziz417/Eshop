<?php
$filePath = realpath(dirname(__FILE__));
include_once($filePath.'/../lib/Database.php');
include_once($filePath.'/../helpers/Format.php');


class shiping
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function shipinInfoInsert(){

        $q = "SELECT * FROM tbl_shiping";
        $r = $this->db->select($q);
        $cId = Session::get("customerId");

        if($r == false){
            $selectCustomerTblData = "SELECT * FROM tbl_customer WHERE customerId = '$cId'";
            $selectResult = $this->db->select($selectCustomerTblData);

            $result  = $selectResult->fetch_assoc();
            $name    = $result['cName'];
            $zipCode = $result['zipCode'];
            $email   = $result['email'];
            $address = $result['address'];
            $phone   = $result['phone'];

            $query = "INSERT INTO tbl_shiping(cId,name,zipCode,email,address,phone) VALUES('$cId', '$name', '$zipCode', '$email','$address','$phone')";
            $insert_row = $this->db->insert($query);
        }

        $query2 = "SELECT * FROM tbl_shiping WHERE cId = '$cId'";
        $selectResult2 = $this->db->select($query2);
        return $selectResult2;
    }

    public function shipingInfoUpdate($data,$cId){
            $name     = $this->fm->validation($data['cName']);
            $zipCode  = $this->fm->validation($data['zipCode']);
            $email    = $this->fm->validation($data['email']);
            $address  = $this->fm->validation($data['address']);
            $phone    = $this->fm->validation($data['phone']);
            $note     = $this->fm->validation($data['note']);

            $cName   = mysqli_real_escape_string($this->db->link, $name);
            $zipCode = mysqli_real_escape_string($this->db->link, $zipCode);
            $email   = mysqli_real_escape_string($this->db->link, $email);
            $address = mysqli_real_escape_string($this->db->link, $address);
            $phone   = mysqli_real_escape_string($this->db->link, $phone);
            $note    = mysqli_real_escape_string($this->db->link, $note);

            if($cName == "" || $zipCode == "" || $email == "" || $address == ""  || $phone == "" ){
                $msg = "<span class='error'> Field must not be empty</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_shiping SET
                        name    = '$cName',
                        zipCode = '$zipCode',
                        email   = '$email',
                        address = '$address',
                        phone   = '$phone',
                        note    = '$note'
                        WHERE cId = '$cId'";
                $result = $this->db->update($query);

                if ($result) {
                    $msg = "<span class='success'>Your Information updated successfully! </span>";
                    header("Location:order.php");
                    return $msg;
                } else {
                    $msg = "<span class='error'>Your Information do not updated! </span>";
                    return $msg;
                }
            }
    }

    public function dltShiping(){
        $query = "DELETE FROM tbl_shiping WHERE cId = '10'";
        $result = $this->db->delete($query);
        return $result;
    }
}
