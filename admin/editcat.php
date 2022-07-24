<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
<?php 
if (!isset($_GET['catid']) || $_GET['catid']==NULL) {
    echo "<script>window.location='catlist.php';</script>";
}else{
    $id = $_GET['catid'];
}
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
                <?php 
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    // $cid = $_POST['id'];
                    $name = $fm->valid($_POST['name']);
                    $name = mysqli_real_escape_string($db->link,$name);
                    if(empty($name)){
                        echo "Field Must not be empty";
                    }else{
                        $sql = "UPDATE tbl_category SET name='$name' WHERE id='$id'";
                        $catupdate = $db->update($sql);
                        if($catupdate){
                            echo "<script>window.location='catlist.php';</script>";
                        }
                    }
                }
                ?>
                <?php 
                $loadSql = "SELECT * FROM tbl_category WHERE id='$id'";
                $catData = $db->select($loadSql);
                while ($cat = $catData->fetch_assoc()){
                ?>
                 <form action="" method="POST">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $cat['id'];?>">
                                <input type="text" name="name" value="<?php echo $cat['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } ?>
                </div>
            </div>
        </div>
<?php 
include "inc/footer.php";
?>
