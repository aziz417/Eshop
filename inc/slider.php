<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
            $pGet = $product->productGetByBrand();
            if($pGet){
                while ($result = $pGet->fetch_assoc()){

            ?>
            <div class="listview_1_of_2 images_1_of_2 " style="margin: 0 !important;">
                <div class="listimg listimg_2_of_1">
                    <a href="productDetails.php?productId=<?php echo $result['productId']?>"> <img src="admin/<?php  echo $result['image']?>" width="60px" height="80px" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $result['brandName']?></h2>
                    <p><?php echo $fm->textShorten($result['body'],30)?></p>
                    <div class="button"><span><a href="productDetails.php?productId=<?php echo $result['productId']?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php  }}?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt=""/></li>
                    <li><img src="images/2.jpg" alt=""/></li>
                    <li><img src="images/3.jpg" alt=""/></li>
                    <li><img src="images/4.jpg" alt=""/></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>