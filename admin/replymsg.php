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
                <h2>Reply Message</h2>
                <?php 
                if ($_SERVER['REQUEST_METHOD']=="POST"){
                    $toEmail = $fm->valid($_POST['toEmail']);
                    $fromEmail = $fm->valid($_POST['fromEmail']);
                    $subject = $fm->valid($_POST['subject']);
                    $message = $fm->valid($_POST['message']);

                    $mail = mail($toEmail, $subject, $message, $fromEmail);
                    if ($mail) {
                        echo "<span style='color:green'>Message Send Successfully</span>";
                    }else{
                        echo "<span style='color:red'>Message not Send</span>";
                    }
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
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="toEmail" value="<?php echo $viewData['email'];?>" readonly  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" placeholder="Please enter your email address" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Please Enter your subject" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea name="message" class="tinymce">
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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
