<?php 
include "inc/header.php";
include "inc/sidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<?php 
    if (isset($_GET['seenid'])) {
        $seenid = $_GET['seenid'];
        $seensql = "UPDATE tbl_contact SET status='1' WHERE id='$seenid'";
        $seenupdate = $db->update($seensql);
        if($seenupdate){
        	echo "<script>window.location='inbox.php';</script>";
        }
    }
     if (isset($_GET['delid'])) {
        $delid = $_GET['delid'];
        $msgdelsql = "DELETE FROM tbl_contact WHERE id='$delid'";
        $msgdeldate = $db->delete($msgdelsql);
        if($msgdeldate){
        	echo "<script>window.location='inbox.php';</script>";
        }
    }

?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Date</th>
							<th>Name</th>
							<th>E-mail</th>
							<th>Body</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php 
				$msgSql = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
				$msgRes = $db->select($msgSql);
				if($msgRes){
					$sl = 0;
					$sl=0;
					while ($msgData = $msgRes->fetch_assoc()) {
						$sl++;
			?>
						<tr class="odd gradeX">
							<td><?php echo $sl;?></td>
							<td><?php echo $fm->FormatDate($msgData['date'])?></td>
							<td><?php echo $msgData['fname']." ".$msgData['lname']?></td>
							<td><?php echo $msgData['email']?></td>
							<td><?php echo $fm->textShorten($msgData['body'],30)?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $msgData['id'];?>">View</a>||
								<a href="replymsg.php?msgid=<?php echo $msgData['id'];?>">Reply</a>||
								<a onclick="return confirm('are you sure!!!')" href="?seenid=<?php echo $msgData['id'];?>">Seen</a>
							</td>
						</tr>
			<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
            <div class="box round first grid">
                <h2>Seen Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Date</th>
							<th>Name</th>
							<th>E-mail</th>
							<th>Body</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
				$afterSeenSql = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
				$afterSeenRes = $db->select($afterSeenSql);
				if($afterSeenRes){
					$sl = 0;
					$sl=0;
					while ($afterSeenData = $afterSeenRes->fetch_assoc()) {
						$sl++;
			?>
						<tr class="odd gradeX">
							<td><?php echo $sl;?></td>
							<td><?php echo $fm->FormatDate($afterSeenData['date'])?></td>
							<td><?php echo $afterSeenData['fname']." ".$afterSeenData['lname']?></td>
							<td><?php echo $afterSeenData['email']?></td>
							<td><?php echo $fm->textShorten($afterSeenData['body'],30)?></td>
							<td>
								<a onclick="return confirm('Are you sure!!!')" href="?delid=<?php echo $afterSeenData['id'];?>">Delete</a>
							</td>
						</tr>
			<?php } } ?>
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
