<?php 
include ("../lib/Session.php");
Session::checkSession();
?>
<?php 
include ("../config/config.php");
include ("../lib/Database.php");
?>
<?php 
$db = new Database();
?>
<?php 
	if (!isset($_GET['delpostid']) || $_GET['delpostid']==NULL){
		echo "<script>window.location='postlist.php';</script>";
	}else{
		$delpostid = $_GET['delpostid'];
		$getDataSql = "SELECT * FROM tbl_post WHERE id='$delpostid'";
		$getDataRes = $db->select($getDataSql);
		while ($data = $getDataRes->fetch_assoc()) {
			unlink($data['image']);
		}

		$delSql = "DELETE FROM tbl_post WHERE id='$delpostid'";
		$delRes = $db->delete($delSql);
		if($delRes){
			echo "<script>window.location='postlist.php';</script>";
		}
	}
?>