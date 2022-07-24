<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
 <?php
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $title = $fm->valid($_POST['title']);
    $slogan = $fm->valid($_POST['slogan']);
    $title = mysqli_real_escape_string($db->link,$title);
    $slogan = mysqli_real_escape_string($db->link,$slogan);

    $permited = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $same_filename = "logo".'.'.$file_ext;
    $uploaded_image = "uploads/".$same_filename;
    if($title=='' || $slogan=='') {
        echo "Field Must not be empty";
    }else{
        if (!empty($file_name)) {
            if($file_size>1048576){
                echo "Image size should be less then 1MB";
            }elseif(in_array($file_ext, $permited)==false){
                echo "You can upload only".implode(',', $permited);
            }else{
                move_uploaded_file($file_tmp, $uploaded_image);
                $updateSql = "UPDATE title_slogan
                    SET
                    title='$title',
                    slogan='$slogan',
                    logo='$uploaded_image'
                    WHERE id='1'
                ";
                $titleUpdateRes = $db->update($updateSql);
                if($titleUpdateRes){
                    echo "Title Update successfully";
                }
            }
    }else{
        $updateSql = "UPDATE title_slogan
            SET
            title='$title',
            slogan='$slogan'
            WHERE id='1'
        ";
        $titleUpdateRes = $db->update($updateSql);
        if($titleUpdateRes){
            echo "Title Update successfully";
        }
    }
}
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock">
                <?php 
                $titleSql ="SELECT * FROM title_slogan WHERE id=1";
                $titleRes = $db->select($titleSql);
                if($titleRes){
                    while ($titleData = $titleRes->fetch_assoc()) {
                ?>           
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $titleData['title'];?>" name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $titleData['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                <img src="<?php echo $titleData['logo'];?>" width="100px" alt=""> <br>
                                <input type="file" name="logo"/>
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php 
include "inc/footer.php";
?>
