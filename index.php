<?php
include ("inc/header.php");
include ("inc/slider.php");
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
	<?php
		$limit = 3;
		if(isset($_GET['page'])){
			$offset = ($_GET['page'] - 1) * $limit;
		}else{
			$offset = 1;
		}
		$sql = "SELECT * FROM tbl_post LIMIT $offset , $limit";
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
		<!-- pagination -->
		<?php 
		$paginationSql = "SELECT * FROM tbl_post";
		$res = $db->select($paginationSql);
		$totalRows = mysqli_num_rows($res);
		$totalPage = ceil($totalRows/$limit);
		?>
		<span class="pagination">
			<a href="index.php?page=1">First Page</a>
			<?php
			for ($i=1; $i <= $totalPage ; $i++) {
				echo "<a href='index.php?page={$i}'>".$i."</a>";
			}
			?>
			<a href="index.php?page=<?php echo $totalPage;?>">Last Page</a>
		</span>
		<!-- pagination -->
		<?php }else{ header("Location:404.php");} ?>
		</div>
		
<?php
include "inc/sidebar.php";
include "inc/footer.php";
?>