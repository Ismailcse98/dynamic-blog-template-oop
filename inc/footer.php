<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <p>&copy; Copyright Training with live project.</p>
	</div>
	<div class="fixedicon clear">
		<?php 
	        $socialLinkSql ="SELECT * FROM tbl_social WHERE id=1";
	        $socialLinkRes = $db->select($socialLinkSql);
	        if($socialLinkRes){
	            $socialLinkData = $socialLinkRes->fetch_assoc();
        ?> 
		<a href="<?php echo $socialLinkData['fb'];?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $socialLinkData['tw'];?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $socialLinkData['ln'];?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $socialLinkData['gp'];?>"><img src="images/gl.png" alt="GooglePlus"/></a>
	<?php } ?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>