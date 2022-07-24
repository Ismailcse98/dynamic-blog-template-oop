<?php 
include "inc/header.php";
include "inc/sidebar.php";
?> 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php 
                if(isset($_GET['deluser'])){
                	$deluser = $_GET['deluser'];
                	$delUserSql = "DELETE FROM tbl_user WHERE id='$deluser'";
                	$result = $db->delete($delUserSql);
                	if ($result) {
                		echo "User Deleted Successfully";
                	}else{
                		echo "User Not deleted";
                	}
                }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>User Name</th>
							<th>E-mail</th>
							<th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$allUserSql = "SELECT * FROM tbl_user ORDER BY id DESC";
						$allUserRes = $db->select($allUserSql);
						if($allUserRes){
							$sl = 0;
							while ($allUserData = $allUserRes->fetch_assoc()) {
						?>
						<tr class="odd gradeX">
							<td><?php echo ++$sl;?></td>
							<td><?php echo $allUserData['name'];?></td>
							<td><?php echo $allUserData['username'];?></td>
							<td><?php echo $allUserData['email'];?></td>
							<td><?php echo $fm->textShorten($allUserData['details'],30);?></td>
							<td><?php
							if ($allUserData['role']==0) {
								echo "Admin";
							}elseif($allUserData['role']==1){
								echo "Author";
							}elseif($allUserData['role']==2){
								echo "Editor";
							}
							?></td>
							<td><a href="viewuser.php?userid=<?php echo $allUserData['id']?>">View</a>

							 <?php  if(Session::get('userRole')==0) { ?>
							 || <a onclick="return confirm('Are you sure???')" href="?deluser=<?php echo $allUserData['id']?>">Delete</a>
							 <?php  } ?>
							 
							</td>
						</tr>
					<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>

<script type="text/javascript">
$(document).ready(function () {
    setupLeftMenu();
    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>

<?php 
include "inc/footer.php";
?>
