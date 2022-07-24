<?php 
include "inc/header.php";
include "inc/sidebar.php";
?> 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php 
                if(isset($_GET['delid'])){
                	$delid = $_GET['delid'];
                	$delCatSql = "DELETE FROM tbl_category WHERE id='$delid'";
                	$db->delete($delCatSql);
                }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = "SELECT * FROM tbl_category ORDER BY id DESC";
						$category = $db->select($sql);
						if($category){
							$sl = 0;
							while ($data = $category->fetch_assoc()) {
						?>
						<tr class="odd gradeX">
							<td><?php echo ++$sl;?></td>
							<td><?php echo $data['name'];?></td>
							<td><a href="editcat.php?catid=<?php echo $data['id']?>">Edit</a> || <a onclick="return confirm('Are you sure???')" href="?delid=<?php echo $data['id']?>">Delete</a></td>
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
