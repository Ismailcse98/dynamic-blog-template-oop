<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
<?php 
$userId = Session::get('userId');
$userRole = Session::get('userRole');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update user profile</h2>

            <?php
                if ($_SERVER['REQUEST_METHOD']=="POST"){
                $name = mysqli_real_escape_string($db->link,$_POST['name']);
                $email = mysqli_real_escape_string($db->link,$_POST['email']);
                $details = mysqli_real_escape_string($db->link,$_POST['details']);

                $updateUserSql = "UPDATE tbl_user SET
                    name='$name',
                    email='$email',
                    details='$details'
                    WHERE id=$userId
                    ";
                $updateUserRes = $db->insert($updateUserSql);
                if($updateUserRes){
                    echo "Update User Information Successfully";
                }else{
                    echo "User Information Not Updated";
                }
            }
                ?>
                <div class="block">      
            <?php 
                $selectUserSql = "SELECT * FROM tbl_user WHERE id=$userId";
                $selectUserRes = $db->select($selectUserSql);
                if($selectUserRes){
                    $userData = $selectUserRes->fetch_assoc();
            ?>         
                 <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $userData['name'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>E-mail</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $userData['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details">
                                    <?php echo $userData['details'];?>
                                </textarea>
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
