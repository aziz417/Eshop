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
    .red_color{
        color: red;
    }

</style>
<div class="main">
    <div class="content">
        <div class="section group">

            <?php

                if(isset($editUserProfile)){
                    echo $editUserProfile;
                }

                if(isset($_POST['submit'])){
                    $cId = Session::get("customerId");
                    $shipingInfoUpdate = $shiping->shipingInfoUpdate($_POST,$cId);
                }

                if(isset($shipingInfoUpdate) && !empty($shipingInfoUpdate)){
                    echo $shipingInfoUpdate;
                }
            ?>



                    <table class="tblone">
                        <form action="" method="post">
                            <tr>
                                <td colspan="3"><h2> <a href="index.php"> << Home </a><span> || </span> Check Out</h2></td>
                            </tr>

                            <?php
                                $userInfo = $shiping->shipinInfoInsert();
                                if($userInfo){
                                while ($result = $userInfo->fetch_assoc()){
                            ?>

                            <tr width="70%">
                                <td width="30%">Name<span class="red_color">*</span></td>
                                <td width="5%">:</td>
                                <td><input type="text" name="cName"required value="<?php echo $result['name'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td>:</td>
                                <td><input type="text" name="zipCode" value="<?php echo $result['zipCode'] ?>"></td>
                            </tr>

                            <tr>
                                <td>Email<span class="red_color">*</span></td>
                                <td>:</td>
                                <td><input type="text" name="email" required value="<?php echo $result['email'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Address<span class="red_color">*</span></td>
                                <td>:</td>
                                <td><input type="text" name="address" required value="<?php echo $result['address'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Phone<span class="red_color">*</span></td>
                                <td>:</td>
                                <td><input type="text" name="phone" required value="<?php echo $result['phone'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Note</td>
                                <td>:</td>
                                <td colspan="3"><textarea type="text" style="width:95%" name="note" value="<?php /*echo $result['note'] */?>"> </textarea></td>
                            </tr>
                            <?php }}?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" name="submit" style="padding: 6px; width: 100px;" value="Continue"> </td>
                            </tr>
                        </form>
                    </table>
        </div>
    </div>
</div>
<?php include'inc/footer.php'?>

