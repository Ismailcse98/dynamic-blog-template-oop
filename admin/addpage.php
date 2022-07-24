<?php 
include "inc/header.php";
include "inc/sidebar.php";
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
                        $pageSql = "INSERT INTO tbl_page(name,body)VALUES('$name','$body')";
                        $pageRes = $db->insert($pageSql);
                        if($pageRes){
                            echo "Page inserted successfully";
                        }
                    }
                }
                ?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Add Page" />
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
