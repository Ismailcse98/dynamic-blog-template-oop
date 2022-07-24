<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
<?php 
    if (!isset($_GET['msgid']) || $_GET['msgid']==NULL) {
        echo "<script>window.location='inbox.php';</script>";
    }else{
        $msgid = $_GET['msgid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
                <?php 
                if ($_SERVER['REQUEST_METHOD']=="POST"){
                    echo "<script>window.location='inbox.php';</script>";
                }
                ?>
                <div class="block">
<?php 
    $viewSql ="SELECT * FROM tbl_contact WHERE id=$msgid";
    $viewRes = $db->select($viewSql);
    if($viewRes){
        $viewData = $viewRes->fetch_assoc();
?>             
                 <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $viewData['fname'];?> <?php echo $viewData['lname'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>E-mail</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $viewData['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $fm->FormatDate($viewData['date']);?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce">
                                    <?php echo $viewData['body'];?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
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
