<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php
            if(!isset($_GET['viewpostid']) || $_GET['viewpostid']==NULL){
                    echo "<script>window.location='postlist.php';</script>";
                }else{
                    $postid = $_GET['viewpostid'];
                }

            if ($_SERVER['REQUEST_METHOD']=="POST"){
                echo "<script>window.location='postlist.php';</script>";
             }
                ?>
                <div class="block">
                <?php 
                $postSql="SELECT * FROM tbl_post WHERE id='$postid'";
                $resSql = $db->select($postSql);
                while ($postData =$resSql->fetch_assoc()) {
                ?>            
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postData['title'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
                                    <option value="">Select Category</option>
                                    <?php 
                                    $catSql = "SELECT * FROM tbl_category ORDER BY name ASC";
                                    $catRes = $db->select($catSql);
                                    while ($cat = $catRes->fetch_assoc()) {
                                    if($cat['id']==$postData['cat']){
                                        $selected="selected";
                                    }else{
                                        $selected="";
                                    }
                                    ?>
                                    <option <?php echo $selected;?> value="<?php echo $cat['id']?>"><?php echo $cat['name'];?></option>
                                <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postData['image'];?>" alt="image not found" width="200px" height="100px">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce">
                                    <?php echo $postData['body'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postData['tags'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo Session::get('username');?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update" Value="Ok" />
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
