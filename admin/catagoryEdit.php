<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/catagory.php';
$cat = new catagory();

if(!isset($_GET['catagoryId']) || $_GET['catagoryId'] ==  NULL){
    echo "<script> window.location = 'catlist.php';</script>";
}else{
    $id = $_GET['catagoryId'];
}
?>
<?php
    if(isset($_POST['submit'])){
        $editCatName = $_POST['catagoryName'];
        $insertCat   = $cat->updateCat($editCatName, $id);
    }
?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Catagory</h2>
            <div class="block copyblock">
                <?php
                if(isset($insertCat)){
                    echo $insertCat;
                }
                ?>
                <?php
                    $getcat = $cat->catagoryEdit($id);
                    if($getcat){
                        while ($result = $getcat->fetch_assoc()){
                ?>
                <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['categoryName']?>" name="catagoryName" class="medium" />
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