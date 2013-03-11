<?php 
/*
	Copyright 2013, Tim Habersack / http://tim.hithlonde.com / tim@hithlonde.com

	This file is part of Lemon-filling.

    Lemon-filling is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Lemon-filling is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Lemon-filling.  If not, see <http://www.gnu.org/licenses/>.

*/
?>
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