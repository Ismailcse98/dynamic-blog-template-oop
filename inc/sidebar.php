<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
						<?php 
						$categorySql = "SELECT * FROM tbl_category";
						$category = $db->select($categorySql);
						if($category){
							while ($data = $category->fetch_assoc()) {
						?>
						<li><a href="posts.php?cat=<?php echo $data['id']?>"><?php echo $data['name']?></a></li>
					<?php } }else{
						echo "<li>No Category Created</li>";
					} ?>				
					</ul>
			</div>
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<?php 
				$recentPostSql = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT 5";
				$recentPost = $db->select($recentPostSql);
				if($recentPost){
					while ($recent = $recentPost->fetch_assoc()) {				?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $recent['id']?>"><?php echo $recent['title'];?></a></h3>
						<a href="post.php?id=<?php echo $recent['id']?>"><img src="admin/<?php echo $recent['image']?>" alt="post image"/></a>
						<p><?php echo $fm->textShorten($recent['body'],100);?></p>	
					</div>
				<?php } }else{ header("Location:404.php"); }?>
	
			</div>
			
		</div>
	</div>