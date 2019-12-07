<?php include'inc/header.php'?>

<?php
    if(isset($_GET['catId'])){
        $catId = $_GET['catId'];
        $getProductByCat = $product->productGetByCategory($catId);
        $getProductByCatname = $product->productGetByCategoryName($catId);
    }
?>

<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
                <?php
                    if($getProductByCatname){
                         $catNameResult = $getProductByCatname->fetch_assoc();
                ?>
                <h3><?php echo $catNameResult['categoryName'] ?></h3>
                <?php } ?>
    		</div>
    		<div class="clear"></div>
    	</div>

        <div class="section group">
            <?php
                if($getProductByCat){
                while ($result = $getProductByCat->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                 <a href="preview-3.html"><img src="admin/<?php echo $result['image']?>" height="200px" width="180px" alt="" /></a>
                 <h2><?php echo $result['productName']?></h2>
                 <p><?php echo $fm->textShorten($result['body'],30)?></p>
                 <p><span class="price">$<?php echo $result['price']?></span></p>
                 <div class="button"><span><a href="productDetails.php?productId=<?php echo $result['productId']?>">Details</a></span></div>
            </div>
            <?php }}else{
                    echo "<p> Product of is category empty Please another category chose <a href='productDetails.php'>Chose Another Category</a></p>";
                }?>
        </div>

    </div>
</div>

<?php include'inc/footer.php'?>

