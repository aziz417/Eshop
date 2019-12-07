<?php include'inc/header.php'?>
<?php include'inc/slider.php'?>
<?php
    $getProduct = $product->fontSelectProduct();
    $getNewProduct = $product->newFontSelectProduct();
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
              <?php if($getProduct){
                  while ($result = $getProduct->fetch_assoc()){
                      ?>
				<div class="grid_1_of_4 images_1_of_4">
                    <a href="productDetails.php?productId=<?php echo $result['productId']?>">
                        <img src="admin/<?php echo $result['image']?>" height="200px" width="180px" alt="Product Photo"/>
                    </a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><span class="price"><?php echo $result['price']?></span></p>
					 <p><?php echo $fm->textShorten($result['body'],60)?></p>
				     <div class="button"><span>
                             <a href="productDetails.php?productId=<?php echo $result['productId']?>" class="details">Details</a>
                         </span>
                     </div>
				</div>
              <?php }}?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
                <?php
                    if($getNewProduct){
                        while ($resultNewProduct = $getNewProduct->fetch_assoc()){
                ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="productDetails.php?productId=<?php echo $resultNewProduct['productId']?>"><img src="admin/<?php echo $resultNewProduct['image']?>" height="200px" width="180px" alt="" /></a>
					 <h2><?php echo $resultNewProduct['productName']?></h2>
					 <p><span class="price">$<?php echo $resultNewProduct['price']?></span></p>
				     <div class="button">
                         <span>
                             <a href="productDetails.php?productId=<?php echo $resultNewProduct['productId']?>" class="details">Details</a>
                         </span>
                     </div>
				</div>
                <?php }} ?>
			</div>
    </div>
 </div>
</div>


 <?php include'inc/footer.php'?>
