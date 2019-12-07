<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php
    $edtcat = new catagory();
    if(isset($_GET['catagoryId'])){
        $id = $_GET['catagoryId'];
        $getcat = $edtcat->catdlt($id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $getcat = $edtcat->catagoryList();
                    if($getcat){
                    $count=1;
                    while ($result = $getcat->fetch_assoc()){
                    ?>
						<tr class="odd gradeX">
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $result['categoryName']?></td>
                            <td><a href="catagoryEdit.php?catagoryId=<?php echo $result['catagoryId'];?>">Edit</a> ||
                                <a onclick="return confirm('Are you sure to Delete?')" href="?catagoryId=
                                <?php echo $result['catagoryId'];?>">Delete</a></td>
						</tr>
                     <?php }}?>
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

