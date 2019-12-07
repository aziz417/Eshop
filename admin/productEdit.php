<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/product.php';?>
<?php $brand = new brand()?>
<?php $catagory = new catagory()?>
<?php $product = new product()?>
<?php
    if(!isset($_GET['productId']) || $_GET['productId'] ==  NULL){
    echo "<script> window.location = 'productlist.php';</script>";
}else{
    $id = $_GET['productId'];
}
    if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $updateProduct = $product->updateProduct($_POST,$_FILES,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">
            <?php
            if(isset($producrInsert1)){
                echo $producrInsert1;
            }
            ?>
            <?php
            if(isset($updateProduct)){
                echo $updateProduct;
            }
            ?>
            <?php
                $editProduct = $product->editProduct($id);
                if($editProduct){
                    while ($value = $editProduct->fetch_assoc()){
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $value['productName']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="catId">
                                <option> Select Category </option>
                                <?php
                                    $getcat = $catagory->catagoryList();
                                    if($getcat){
                                        while ($result = $getcat->fetch_assoc()){
                                ?>
                                        <option
                                            <?php if($value['catId'] == $result['catagoryId']){?>
                                                selected = "selected"
                                           <?php }?>
                                            value="<?php echo $result['catagoryId']?>">
                                            <?php echo $result['categoryName']?></option>
                                    <?php  }} ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brandId">
                                <option>Select Brand</option>
                                <?php
                                $getbrand = $brand->brandList();
                                if($getbrand){
                                    while ($result = $getbrand->fetch_assoc()){
                                        ?>
                                        <option
                                            <?php if($value['brandId'] == $result['brandId']){?>
                                                selected = "selected"
                                            <?php }?>
                                            value="<?php echo $result['brandId']?>"><?php echo $result['brandName']?></option>
                                    <?php   }} ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="body" class="text" style="width: 500px; height: 80px">
                                <?php
                                    echo $value['body'];
                                ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $value['price'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $value['image']?>" width="120px" height="150px"><br>
                            <input name="image" type="file" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php if($value['type'] == 0){?>
                                <option selected value="0">Featured</option>
                                <option value="1">General</option>
                                <?php }else{?>
                                <option value="0">Featured</option>
                                <option selected value="1">General</option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


