<?php include'inc/header.php' ?>
<style>
    .tblone{
        width: 600px;
        margin: 0 auto;
        border: 2px solid #ddd;
    }
    .tblone tr td input{
        width: 90%;
        padding: 8px;
    }
    .tblone tr td{
        text-align: justify;
    }

</style>
<div class="main">
    <div class="content">
        <div class="section group">

            <?php
            if(isset($_POST['submit'])){
                $cid = Session::get("customerId");
                $editUserProfile = $customer->fEditUserProfile($_POST,$cid);
            }

            if(isset($editUserProfile)){
                echo $editUserProfile;
            }
            ?>

            <?php
            $userInfo = $customer->userDetails();
            if($userInfo){
                while ($result = $userInfo->fetch_assoc()){
                    ?>

                    <table class="tblone">
                        <form action="" method="post">
                            <tr>
                                <td colspan="3"><h2>User Profile Details</h2></td>
                            </tr>
                            <tr width="70%">
                                <td width="30%">Name</td>
                                <td width="5%">:</td>
                                <td><input type="text" name="cName" value="<?php echo $result['cName'] ?>"></td>
                            </tr>

                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
                            </tr>

                            <tr>
                                <td>Zip Code</td>
                                <td>:</td>
                                <td><input type="text" name="zipCode" value="<?php echo $result['zipCode'] ?>"></td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td><input type="text" name="country" value="<?php echo $result['country'] ?>"></td>
                            </tr>
                            <tr>
                                <td>phone</td>
                                <td>:</td>
                                <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                            </tr>
                            <!--<tr>
                                <td>Password</td>
                                <td>:</td>
                                <td><input type="password" name="pass" id="myInput" value="<?php /*echo $result['pass'];*/?> ">
                                    <input type="checkbox" onclick="myFunction()" style="width: 15%!important; padding: 0px;">Show Password
                                    <script>
                                        function myFunction() {
                                            var x = document.getElementById("myInput");
                                            if (x.type === "password") {
                                                x.type = "text";
                                            } else {
                                                x.type = "password";
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>-->
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" name="submit" style="padding: 6px; width: 100px;" value="Update"> </td>
                            </tr>
                        </form>
                    </table>
                <?php }}?>
        </div>
    </div>
</div>
<?php include'inc/footer.php'?>

