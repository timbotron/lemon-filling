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
	<div class="offset2 span8">
		<h2>Edit Locale</h2>
		<?php echo validation_errors()."\n";
				echo form_open(uri_string(),array('class'=>'form-horizontal'))."\n";
		?>
		    
		    <div class="control-group">
		    <label class="control-label" for="value">Locale:</label>
		    <div class="controls">
		    <input type="text" name="value" placeholder="Locale" value="<?php echo set_value('value',$passed['value']);?>">
		    </div>
		    </div>
		    
		    
		    <div class="control-group">
		    <div class="controls">
		    
		    <input type="submit" class="btn btn-primary" value="Save Changes">
		    </div>
		    </div>
		    </form>

		    <form class="form-horizontal well">
        <fieldset>     
        <div class="control-group">          
          <div class="controls">
            <h3>Delete Locale</h3>
          </div>
        </div>  
                <div class="alert alert-error">                
                <h4 class="alert-heading">Warning!</h4>
                This will delete the locale, and any terms defined in that locale.<br /> There are currently <strong><?php echo $num_terms['the_count']; ?></strong> terms defined in this locale. This cannot be undone.
                </div>          
         
        <div class="control-group">
          <div class="controls">
            <a href="<?php echo site_url('locale'); ?>" class="btn">Cancel</a>
            <a href="<?php echo site_url('locale/delete/'.$passed['locale_id']); ?>" class="btn btn-danger">Delete Locale</a>            
          </div>
        </div>
                  
      </fieldset>
      </form>

	</div>
	</div>
</div> <!-- /container -->

</body>
</html>
