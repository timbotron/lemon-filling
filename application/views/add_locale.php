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
		<h2>Add Locale</h2>
		<?php echo validation_errors()."\n";
				echo form_open(uri_string(),array('class'=>'form-horizontal'))."\n";
		?>
		    
		    <div class="control-group">
		    <label class="control-label" for="value">Locale:</label>
		    <div class="controls">
		    <input type="text" autofocus="autofocus" name="value" maxlength="90" placeholder="ex. English" value="<?php echo set_value('value');?>">
		    </div>
		    </div>

		  
		    
		    <div class="control-group">
		    <div class="controls">
		    
		    <input type="submit" class="btn btn-primary" value="Save Locale">
		    </div>
		    </div>
		    </form>

	</div>
	</div>
</div> <!-- /container -->

</body>
</html>
