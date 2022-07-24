<?php
include "inc/header.php";
if(isset($_GET['id'])){
	$post_id = $_GET['id'];
	$sql = "SELECT * FROM tbl_post WHERE id = '$post_id'";
	$result = $db->select($sql);
}else{
	header("Location:404.php");
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			<?php
			if($result){
				while ($data = $result->fetch_assoc()) {
			?>
				<h2><?php echo $data['title'];?></h2>
				<h4><?php echo $fm->FormatDate($data['date'])?>, By <?php echo $data['author']?></h4>
				<img src="admin/<?php echo $data['image']?>" alt="MyImage"/>
				<p><?php echo $data['body'];?></p>
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
					$catId = $data['cat'];
					$relatedQuery = "SELECT * FROM tbl_post WHERE cat ='$catId' ORDER BY rand() LIMIT 6";
					$relatedResult = $db->select($relatedQuery);
					if($relatedResult){
						while ($relatedData = $relatedResult->fetch_assoc()) {
					?>
					<a href="post.php?id=<?php echo $relatedData['id']?>"><img src="admin/<?php echo $relatedData['image']?>" alt="post image"/></a>
				<?php } } ?>
				</div>
		<?php  } } else{ header("Location:404.php"); } ?>
			</div>
		</div>
<?php
include "inc/sidebar.php";
include "inc/footer.php";
?>