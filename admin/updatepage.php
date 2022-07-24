<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
<?php 
if (!isset($_GET['pageId']) || $_GET['pageId']==NULL) {
    echo "<script>window.location='index.php';</script>";
}else{
    $pageId = $_GET['pageId'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php 
                if ($_SERVER['REQUEST_METHOD']=="POST"){
                    $name = mysqli_real_escape_string($db->link,$_POST['name']);
                    $body = mysqli_real_escape_string($db->link,$_POST['body']);

                    if($name=='' || $body=='') {
                        echo "Field Must not be empty";
                    }else{
                        $pageUpdateSql = "UPDATE tbl_page
                            SET
                            name='$name',
                            body='$body'
                            WHERE id=$pageId
                        ";
                        $pageUpdateRes = $db->update($pageUpdateSql);
                        if($pageUpdateRes){
                            echo "Page Update successfully";
                        }
                    }
                }
                ?>
                <div class="block">
        <?php 
        $pageLoadSql ="SELECT * FROM tbl_page WHERE id=$pageId";
        $pageLoadRes = $db->select($pageLoadSql);
        if($pageLoadRes){
            $pageLoadData = $pageLoadRes->fetch_assoc();
        ?>            
                 <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $pageLoadData['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $pageLoadData['body'];?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Page" />
                                <button><a href="page_delete.php?delId=<?php echo $pageLoadData['id'];?>">Delete</a></button>
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } ?>
                </div>
            </div>
        </div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php 
include "inc/footer.php";
?>
