<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
<?php 
if(!Session::get('userRole')==0) {
    echo "<script>window.location='index.php';</script>";
}?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
            <?php 
                if ($_SERVER['REQUEST_METHOD']=="POST"){
                $username = mysqli_real_escape_string($db->link,$_POST['username']);
                $password = mysqli_real_escape_string($db->link,md5($_POST['password']));
                $email = mysqli_real_escape_string($db->link,$_POST['email']);
                $role = mysqli_real_escape_string($db->link,$_POST['role']);
                if (empty($username)||empty($email)||empty($password)) {
                    echo "Field must not be empty";
                }else{
                    $mailQuery = "SELECT * FROM tbl_user WHERE email='$email' limit 1";
                    $mailCheck = $db->select($mailQuery);
                    if($mailCheck){
                        echo "E-mail Already Exist";
                    }else{
                        $addUserSql = "INSERT INTO tbl_user(username,password,email,role)VALUES('$username','$password','$email',$role')";
                        $addUserRes = $db->insert($addUserSql);
                        if($addUserRes){
                            echo "User Created Successfully";
                        }else{
                            echo "User Not Created";
                        }
                    }
                }
            }
                ?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>E-mail</label>
                            </td>
                            <td>
                                <input type="email" name="email" placeholder="Enter valid email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" placeholder="Enter password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select name="role" id="">
                                    <option>Select User</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
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
