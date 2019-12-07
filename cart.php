<?php include'inc/header.php'?>

<?php
    if(isset($_POST['submit'])){
        $updateCartQuantity = $cart->updateCartQuantity($_POST);
    }
if(isset($_GET['cartDltId'])){
    $cartDltId = $_GET['cartDltId'];
        $getCartDltId = $cart->cartDltId($cartDltId);
}
if(!isset($_GET['id'])){
        echo "<meta http-equiv='refresh' content=0;URL=?id=live'/>";
}
?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
                <?php
                    if(isset($updateCartQuantity)){
                        echo $updateCartQuantity;
                    }
                    if(isset($getCartDltId)){
                        echo $getCartDltId;
                    }
                ?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="25%">Product Name</th>
								<th width="15%">Image</th>
								<th width="10%">Price</th>
								<th width="20%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
                            <?php
                                $subTotalPrice=0;
                                $totalProductQuantity = 0;
                                $getProductDetails = $cart->cartSelect();
                                if($getProductDetails){
                                    $sl = 1;
                                    while ($result = $getProductDetails->fetch_assoc()){
                            ?>
							<tr>
								<td><?php echo $sl++ ?></td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/<?php echo $result['image']  ?>" alt=""/></td>
								<td>$<?php echo $result['price']  ?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="quantity" value="<?php echo $result['quantity'] ?>"/>
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$<?php
                                    $totalPrice = $result['price'] * $result['quantity'];
                                    $totalProductQuantity = $totalProductQuantity + $result['quantity'];
                                    Session::set("quantity",$totalProductQuantity);
                                    echo $totalPrice;
                                    $subTotalPrice = $subTotalPrice+$totalPrice;
                                    ?></td>
								<td><a href="?cartDltId=<?php echo $result['cartId']?>">X</a></td>
							</tr>
                                        <?php  }} ?>
						</table>

                        <?php
                            if($getProductDetails){
                        ?>

                        <table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK. <?php echo number_format($subTotalPrice);?></td>
							</tr>
							<tr>
								<th>VAT : 12% </th>
								<td>TK. <?php $vat = ($subTotalPrice/12); echo number_format($vat ,2);; ?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. <?php $grandTital = $subTotalPrice + $vat; echo number_format($grandTital);?>
                                <?php
                                    Session::set("totalPrice", $grandTital);
                                ?>
							</tr>
					   </table>
                            <?php }else{
                                echo "<script>alert('Your cart empty !')</script>";
                                echo "<script>window.open('index.php','_self')</script>";
                            }?>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="shiping.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

<?php include'inc/footer.php'?>


