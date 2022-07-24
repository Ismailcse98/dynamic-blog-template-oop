<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php 
                if ($_SERVER['REQUEST_METHOD']=="POST"){
                    $userId = mysqli_real_escape_string($db->link,$_POST['userId']);
                    $title = mysqli_real_escape_string($db->link,$_POST['title']);
                    $cat = mysqli_real_escape_string($db->link,$_POST['cat']);
                    $body = mysqli_real_escape_string($db->link,$_POST['body']);
                    $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
                    $author = mysqli_real_escape_string($db->link,$_POST['author']);

                    $permited = array('jpg','jpeg','png','gif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $nuique_filename = substr(time(),0,10).'.'.$file_ext;
                    $uploaded_image = "uploads/".$nuique_filename;
                    if($title=='' || $cat=='' || $body=='' || $tags=='' || $author== '' || $file_name=='') {
                        echo "Field Must not be empty";
                    }elseif($file_size>1048576){
                        echo "Image size should be less then 1MB";
                    }elseif(in_array($file_ext, $permited)==false){
                        echo "You can upload only".implode(',', $permited);
                    }else{
                        move_uploaded_file($file_tmp, $uploaded_image);
                        $postSql = "INSERT INTO tbl_post(user_id,cat,title,body,image,author,tags)VALUES($userId,$cat','$title','$body','$uploaded_image','$author','$tags')";
                        $postRes = $db->insert($postSql);
                        if($postRes){
                            echo "<script>window.location='postlist.php';</script>";
                        }
                    }
                }
                ?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option value="">Select Category</option>
                                    <?php 
                                    $catSql = "SELECT * FROM tbl_category ORDER BY name ASC";
                                    $catRes = $db->select($catSql);
                                    while ($cat = $catRes->fetch_assoc()) {
                                    
                                    ?>
                                    <option value="<?php echo $cat['id']?>"><?php echo $cat['name'];?></option>
                                <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter tags..." class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get('username');?>" class="medium" />

                                <input type="hidden" name="userId" value="<?php echo Session::get('userId');?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
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
