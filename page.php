<?php
include "inc/header.php";
?>

<?php 
	if (!isset($_GET['pageId']) || $_GET['pageId']==NULL) {
		header("Location:404.php");
	}else{
	    $pageId = $_GET['pageId'];
	}
?>
	<div class="contentsection contemplete clear">
<?php 
    $loadSql = "SELECT * FROM tbl_page WHERE id='$pageId'";
    $loadRes = $db->select($loadSql);
    if ($loadRes) {
    	$loadData = $loadRes->fetch_assoc();
?>
	<div class="maincontent clear">
		<div class="about">
			<h2><?php echo $loadData['name'];?></h2>
			<p><?php echo $loadData['body'];?></p>
	</div>

		</div>
<?php } ?>
		
<?php
include "inc/sidebar.php";
include "inc/footer.php";
?>