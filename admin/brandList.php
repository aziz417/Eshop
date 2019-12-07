<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
$brand = new brand();
if(isset($_GET['brandId'])){
    $id = $_GET['brandId'];
    $getbrand = $brand->branddlt($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $getbrand = $brand->brandList();
                if($getbrand){
                    $count=1;
                    while ($result = $getbrand->fetch_assoc()){
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $result['brandName']?></td>
                            <td><a href="brandEdit.php?brandId=<?php echo $result['brandId'];?>">Edit</a> ||
                                <a onclick="return confirm('Are you sure to Delete?')" href="?brandId=
                                <?php echo $result['brandId'];?>">Delete</a></td>
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

