<?php
include ("inc/header.php");
include ("inc/slider.php");
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
	<?php
		if(isset($_GET['cat'])){
			$id = $_GET['cat'];
		}else{
			header("Location:404.php");
		}
		$sql = "SELECT * FROM tbl_post WHERE cat = '$id'";
		$result = $db->select($sql);
		if($result ){
			while ($row = $result->fetch_assoc()) {
	?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $row['id']?>"><?php echo $row['title']?></a></h2>
				<h4><?php echo $fm->FormatDate($row['date'])?> , By <a href="#"><?php echo $row['author']?></a></h4>
				 <a href="post.php?id=<?php echo $row['id']?>"><img src="admin/<?php echo $row['image']?>" alt="post image"/></a>
				<p><?php echo $fm->textShorten($row['body']);?></p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $row['id']?>">Read More</a>
				</div>
			</div>
		<?php } ?>
		<?php }else{
			echo "<h2 style='text-align:center;font-size:28px;'>No post available in this cetagory...</h2>";
		} ?>
		</div>
		
<?php
include "inc/sidebar.php";
include "inc/footer.php";
?>