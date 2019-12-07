<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/product.php';?>
<?php $brand = new brand()?>
<?php $fm = new Format()?>
<?php $catagory = new catagory()?>
<?php $product = new product()?>

<?php
    if(isset($_GET['dltId'])){
        $dltProduct = $product->dltProduct($_GET['dltId']);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
            <?php
                $productList = $product->selectProduct();
                if($productList){
                    $count=1;
                    while ($result = $productList->fetch_assoc()){
            ?>
				<tr class="odd gradeX">
					<td><?php echo $count++?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['categoryName']?></td>
					<td><?php echo $result['brandName']?></td>
					<td><?php echo $fm->textShorten($result['body'],30);?></td>
					<td>$<?php echo $result['price']?></td>
					<td><img src="<?php echo $result['image']?>"height="30px" width="40px"/></td>
					<td><?php
                        if($result['type']==0){
                            echo "Featured";
                        }else{
                            echo "General";
                        }
                        ?></td>
					<td><a href="productEdit.php?productId=<?php echo $result['productId']?>">Edit</a> || <a href="#?dltId=<?php echo $result['productId']?>">Delete</a></td>
				</tr>
                    <?php  } }?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
