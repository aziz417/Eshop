<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';
$brand = new brand();

if(!isset($_GET['brandId']) || $_GET['brandId'] ==  NULL){
    echo "<script> window.location = 'brandList.php';</script>";
}else{
    $id = $_GET['brandId'];
}
?>
<?php
if(isset($_POST['submit'])){
    $brandName = $_POST['brandName'];
    $insertBrand   = $brand->updateBrand($brandName, $id);
}
?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Brand</h2>
            <div class="block copyblock">
                <?php
                if(isset($insertBrand)){
                    echo $insertBrand;
                }
                ?>
                <?php
                $getbrand = $brand->editBrand($id);
                if($getbrand){
                    while ($result = $getbrand->fetch_assoc()){
                        ?>
                        <form action="" method="POST">
                            <table class="form">
                                <tr>
                                    <td>
                                        <input type="text" value="<?php echo $result['brandName']?>" name="brandName" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="submit" Value="Save" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    <?php }}?>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>