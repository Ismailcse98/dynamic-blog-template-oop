<?php 
include "inc/header.php";
include "inc/sidebar.php";
?> 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Image</th>
							<th>Author</th>
							<th>Tags</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$postListSql = "SELECT tbl_post.*, tbl_post.id as post_id,tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.id DESC";
						$resPostList = $db->select($postListSql);
						$sl = 0;
						while ($postData = $resPostList->fetch_assoc()){
						?>
						<tr class="odd gradeX">
							<th><?php echo ++$sl;?></th>
							<th><?php echo $postData['title'];?></th>
							<th><?php echo $fm->textShorten($postData['body'],50);?></th>
							<th><?php echo $postData['name'];?></th>
							<th><img src="<?php echo $postData['image'];?>" alt="not found" width="40px" height="40px"></th>
							<th><?php echo $postData['author'];?></th>
							<th><?php echo $postData['tags'];?></th>
							<th><?php echo $fm->FormatDate($postData['date']);?></th>
							<td>
	<a href="viewpost.php?viewpostid=<?php echo $postData['post_id']?>">View</a>
	<?php 
	if (Session::get('userId')==$postData['user_id'] || Session::get('userId')=='0') {
	?>
	|| 
	<a href="eidtpost.php?editpostid=<?php echo $postData['post_id']?>">Edit</a> || 
	<a onclick="return confirm('Are you sure!!')" href="post_delete.php?delpostid=<?php echo $postData['post_id'];?>">Delete</a>
<?php } ?>
							</td>
						</tr>
					<?php } ?>
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

