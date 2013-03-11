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
		<h2>Add Term</h2>
		<?php echo validation_errors()."\n";
				echo form_open(uri_string(),array('class'=>'form-horizontal'))."\n";
		?>
		    
		    <div class="control-group">
		    <label class="control-label" for="term_key">Term Key:</label>
		    <div class="controls">
		    <input type="text" autofocus="autofocus" name="term_key" maxlength="90" placeholder="welcome_blurb" value="<?php echo set_value('term_key');?>">
		    </div>
		    </div>
		    <div class="control-group">
		    <label class="control-label" for="rosetta_value">Term Definition:</label>
		    <div class="controls">
		    <textarea class="input-xlarge" rows="8" maxlength="19999" name="rosetta_value" placeholder="Welcome to App-land, we hope.." value="<?php echo set_value('rosetta_value');?>"></textarea>
		    </div>
		    </div>
		    <div class="control-group">
		    <label class="control-label" for="term_key">Language used:</label>
		    <div class="controls">
		    	<select class ="input-medium" id="viewing_lang" name="viewing_lang">
						<?php 
						foreach($locale_dropdown as $key => $option)
						{
							if($key==$this->uri->segment(3))
							{
								printf('<option selected="selected" value="%s">%s</option>',$key,$option);
							}
							else
							{
								printf('<option value="%s">%s</option>',$key,$option);						
							}
						}
						?>

					</select>		    
		    </div>
		    </div>		  
		    
		    <div class="control-group">
		    <div class="controls">
		    
		    <input type="submit" class="btn btn-primary" value="Save Term">
		    </div>
		    </div>
		    </form>

	</div>
	</div>
</div> <!-- /container -->

</body>
</html>
