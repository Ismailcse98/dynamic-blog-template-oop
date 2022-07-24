<?php 
include "inc/header.php";
include "inc/sidebar.php";
?> 
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
                <?php 
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $name = $fm->valid($_POST['name']);
                    $name = mysqli_real_escape_string($db->link,$name);
                    if(empty($name)){
                        echo "Field Must not be empty";
                    }else{
                        $sql = "INSERT INTO tbl_category(name) VALUES('$name')";
                        $catinsert = $db->insert($sql);
                        if($catinsert){
                            echo "Category inserted successfully";
                        }
                    }
                }
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php 
include "inc/footer.php";
?>
