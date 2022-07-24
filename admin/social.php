<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
    <?php 
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $fb = $fm->valid($_POST['fb']);
            $tw = $fm->valid($_POST['tw']);
            $ln = $fm->valid($_POST['ln']);
            $gp = $fm->valid($_POST['gp']);
            $fb = mysqli_real_escape_string($db->link,$fb);
            $tw = mysqli_real_escape_string($db->link,$tw);
            $ln = mysqli_real_escape_string($db->link,$ln);
            $gp = mysqli_real_escape_string($db->link,$gp);
            if($fb=='' || $tw=='' || $ln=='' || $gp=='') {
                echo "Field Must not be empty";
            }else{
                 $updateSql = "UPDATE tbl_social
                    SET
                    fb='$fb',
                    tw='$tw',
                    ln='$ln',
                    gp='$gp'
                    WHERE id='1'
                ";
                $linkUpdateRes = $db->update($updateSql);
                if($linkUpdateRes){
                    echo "Social Link Update successfully";
                }
            }
        }
     ?>
                <div class="block">
                <?php 
                $socialLinkSql ="SELECT * FROM tbl_social WHERE id=1";
                $socialLinkRes = $db->select($socialLinkSql);
                if($socialLinkRes){
                    $socialLinkData = $socialLinkRes->fetch_assoc();
                ?>             
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $socialLinkData['fb'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $socialLinkData['tw'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $socialLinkData['ln'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $socialLinkData['gp'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
