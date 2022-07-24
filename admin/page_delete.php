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
	if (!isset($_GET['delId']) || $_GET['delId']==NULL){
		echo "<script>window.location='index.php';</script>";
	}else{
		$delId = $_GET['delId'];
		$delSql = "DELETE FROM tbl_page WHERE id='$delId'";
		$delRes = $db->delete($delSql);
		if($delRes){
			echo "<script>window.location='index.php';</script>";
		}
	}
?>