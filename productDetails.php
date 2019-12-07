<?php include'inc/header.php' ?>
<?php
    if(isset($_GET['productId'])){
        $id = $_GET['productId'];
        $detailsProduct = $product->productDetails($id);
    }else{
        header("Location:error402.php");
    }

    if(isset($_POST['submit'])){
        $quantity = $_POST['quantity'];
        $cart->getProductInfo($quantity,$id);
    }
?>
<div class="main">
    <div class="content">
    	<div class="section group">
            <?php
                if($detailsProduct){
                    while ($result = $detailsProduct->fetch_assoc()) {
            ?>
				<div class="cont-desc span_1_of_2">
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'] ?> </h2>
					<p><?php echo $fm->textShorten($result['body'],130) ?></p>
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'] ?></span></p>
						<p>Category: <span><?php echo $result['categoryName'] ?></span></p>
						<p>Brand: <span><?php echo $result['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['body'] ?></p>
                <?php  }}else{
                    echo 'not found data';
                } ?>
	    </div>
	</div>



				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
                        <?php
                        $getcat = $category->catagoryList();
                        if($getcat){
                            while ($result = $getcat->fetch_assoc()){
                                ?>
				                    <li value="<?php echo $result['catagoryId']?>"><a href="productbycat.php?catId=<?php echo $result['catagoryId']?>"> <?php echo $result['categoryName']?></a></li>
                        <?php   }} ?>
    				</ul>
 				</div>
 		</div>
 	</div>
	</div>
<?php include'inc/footer.php'?>

