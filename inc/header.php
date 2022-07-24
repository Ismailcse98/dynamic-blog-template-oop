<?php 
include ("config/config.php");
include ("lib/Database.php");
include ("helpers/Format.php");
?>
<?php 
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
<?php
	if(isset($_GET['pageId'])){
		$pageId = $_GET['pageId'];
		$pagesql = "SELECT * FROM tbl_page WHERE id = '$pageId'";
		$pageRes = $db->select($pagesql);
		$pageTitle = $pageRes->fetch_assoc();
?>
<title><?php echo $pageTitle['name'];?> - <?php echo TITLE;?></title>
<?php
	}elseif(isset($_GET['id'])){
		$postid = $_GET['id'];
		$postSql = "SELECT * FROM tbl_post WHERE id = '$postid'";
		$postRes = $db->select($postSql);
		$postTitle = $postRes->fetch_assoc();
	?>
	<title><?php echo $postTitle['title'];?> - <?php echo TITLE;?></title>
	<?php
	}else{
		?>
		<title><?php echo $fm->title();?> - <?php echo TITLE;?></title>
<?php } ?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php 
		if(isset($_GET['id'])) {
			$keywordid = $_GET['id'];
			$keywordSql = "SELECT * FROM tbl_post WHERE id = '$keywordid'";
			$keywordRes = $db->select($keywordSql);
			$keywordData = $keywordRes->fetch_assoc();
			if ($keywordData) {
				?>
				<meta name="keywords" content="<?php echo $keywordData['tags']?>">
				<?php
			}
		}else{ ?>
			<meta name="keywords" content="<?php echo KEYWORDS; ?>">
		<?php } ?>
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
  <?php 
$titleSql ="SELECT * FROM title_slogan WHERE id=1";
$titleRes = $db->select($titleSql);
if($titleRes){
    while ($titleData = $titleRes->fetch_assoc()) {
?>
		<img src="admin/<?php echo $titleData['logo']?>" alt="Logo"/>
		<h2><?php echo $titleData['title'];?></h2>
		<p><?php echo $titleData['slogan'];?></p>
<?php } } ?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
		<?php 
	        $socialLinkSql ="SELECT * FROM tbl_social WHERE id=1";
	        $socialLinkRes = $db->select($socialLinkSql);
	        if($socialLinkRes){
	            $socialLinkData = $socialLinkRes->fetch_assoc();
        ?> 
				<a href="<?php echo $socialLinkData['fb'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $socialLinkData['tw'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $socialLinkData['ln'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $socialLinkData['gp'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="GET">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
	<?php 
		$currentPath = $_SERVER['SCRIPT_FILENAME'];
		$currentFileName = basename($currentPath,".php");
	?>
		<li><a
			<?php 
			if ($currentFileName=='index') {
				echo 'id="active"';
			}
			?>
		href="index.php">Home</a></li>
		          <?php 
                $pageSql ="SELECT * FROM tbl_page";
                $pageRes = $db->select($pageSql);
                if($pageRes){
                    while ($pageData = $pageRes->fetch_assoc()) {
                ?> 
                <li><a 
                	<?php if(isset($_GET['pageId']) && $_GET['pageId']==$pageData['id']) {
                		echo 'id="active"';
                	}?>
                href="page.php?pageId=<?php echo $pageData['id'];?>"><?php echo $pageData['name'];?></a></li>
            <?php } } ?>
		<li><a 
			<?php 
			if ($currentFileName=='contact_us'){
				echo 'id="active"';
			}
			?>
		 href="contact_us.php">Contact</a></li>
	</ul>
</div>