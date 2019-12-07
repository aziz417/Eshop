<?php
$filePath = realpath(dirname(__FILE__));
include_once($filePath.'/../lib/Database.php');
include_once($filePath.'/../helpers/Format.php');


class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function createUser($data){
        $cName    = $this->fm->validation($data['cName']);
        $city     = $this->fm->validation($data['city']);
        $zipCode  = $this->fm->validation($data['zipCode']);
        $email    = $this->fm->validation($data['email']);
        $address  = $this->fm->validation($data['address']);
        $country  = $this->fm->validation($data['country']);
        $phone    = $this->fm->validation($data['phone']);
        $pass     = $this->fm->validation($data['pass']);
        $pass     = md5($pass);

        $cName   = mysqli_real_escape_string($this->db->link, $cName);
        $city    = mysqli_real_escape_string($this->db->link, $city);
        $zipCode = mysqli_real_escape_string($this->db->link, $zipCode);
        $email   = mysqli_real_escape_string($this->db->link, $email);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone   = mysqli_real_escape_string($this->db->link, $phone);
        $pass    = mysqli_real_escape_string($this->db->link, $pass);


        if($cName == "" || $city == "" || $zipCode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $pass == "" ){
            $msg = "<span class='error'> Fild must not be empty</span>";
            return $msg;
        }else{
            $query = "INSERT INTO tbl_customer(cName,city,zipCode,email,address,country,phone,pass) VALUES('$cName', '$city', '$zipCode', '$email','$address','$country','$phone','$pass')";
            $insert_row = $this->db->insert($query);
            if($insert_row){
                $msg = "<span class='success'> User Create Successfully</span>";
                return $msg;
            }else{
                $msg = "<span class='error'> User Create not Successfully</span>";
                return $msg;
            }
        }
    }

    public function fuserLogin($data)
    {
        $email = $this->fm->validation($data['email']);
        $pass = $this->fm->validation($data['pass']);
        $pass = md5($pass);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = mysqli_real_escape_string($this->db->link, $pass);

        if (empty($email) || empty($pass)) {
            $msg = "<span class='error'> Field must not be empty</span>";
            return $msg;
        } else {
            $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass'";
            $result = $this->db->select($query);

            if($result != false){
                $value = $result->fetch_assoc();
                Session::set("customerLogin",true);
                Session::set("customerId",$value['customerId']);
                Session::set("customerName",$value['cName']);
                header("Location:index.php");
            }else{
                $msg = "<span class='error'> Email Password not match</span>";
                return $msg;
            }
        }
    }

    public function userDetails(){
        $cid = Session::get("customerId");
        $query = "SELECT * FROM tbl_customer WHERE customerId = '$cid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function fEditUserProfile($data,$cid){
        $cName    = $this->fm->validation($data['cName']);
        $city     = $this->fm->validation($data['city']);
        $zipCode  = $this->fm->validation($data['zipCode']);
        $email    = $this->fm->validation($data['email']);
        $address  = $this->fm->validation($data['address']);
        $country  = $this->fm->validation($data['country']);
        $phone    = $this->fm->validation($data['phone']);
        /*$pass     = $this->fm->validation($data['pass']);
        $pass     = md5($pass);*/

        $cName   = mysqli_real_escape_string($this->db->link, $cName);
        $city    = mysqli_real_escape_string($this->db->link, $city);
        $zipCode = mysqli_real_escape_string($this->db->link, $zipCode);
        $email   = mysqli_real_escape_string($this->db->link, $email);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $phone   = mysqli_real_escape_string($this->db->link, $phone);
       /* $pass    = mysqli_real_escape_string($this->db->link, $pass);*/

        if($cName == "" || $city == "" || $zipCode == "" || $email == "" || $address == "" || $country == "" || $phone == "" ){
            $msg = "<span class='error'> Field must not be empty</span>";
            return $msg;
        }else{
                $query = "UPDATE tbl_customer SET
                        cName   = '$cName',
                        city    = '$city',
                        zipCode = '$zipCode',
                        email   = '$email',
                        address = '$address',
                        country = '$country',
                        phone   = '$phone'
                        WHERE customerId = '$cid'";
                $result = $this->db->update($query);

                if ($result) {
                    $msg = "<span class='success'>User details updated successfully! </span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>User details do not updated! </span>";
                    return $msg;
                }
            }
    }
}