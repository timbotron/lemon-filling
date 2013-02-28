<div class="container">
	<div class="row">
	<div class="offset3 span6">
		<div class="alert alert-success"><strong>Success! </strong> <?php echo $message;?></div>


<script type="text/javascript"> 
function closeme() {

	window.location.href="<?php echo site_url($this->uri->segment(1));?>";
}

setTimeout('closeme()', 1000);
</script>
	</div>
	</div>
</div> <!-- /container -->

</body>
</html>