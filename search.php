<?php
include ("inc/header.php");
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
	<?php
		if(isset($_GET['search'])){
			$search = $_GET['search'];
		}else{
			header("Location:404.php");
		}
		if(!empty($search)){
		$sql = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
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
			echo "<h2>Your Search Not Found</h2>";
		} }else{
			echo "<h2>Please Enter Value</h2>";
		} ?>
		</div>
		
<?php
include "inc/sidebar.php";
include "inc/footer.php";
?>