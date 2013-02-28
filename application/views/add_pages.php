<div class="container">
	<div class="row">
	<div class="offset3 span6">
		<h2>Add Page</h2>
		<?php echo validation_errors()."\n";
				echo form_open(uri_string(),array('class'=>'well'))."\n";
		?>
		    
		   <label for="page_name">Page Name:</label>
		    
		    <input class="input-large" type="text" name="page_name" maxlength="90" placeholder="welcome_screen" value="<?php echo set_value('page_name');?>"><br />

		    <select multiple="multiple" name="all_options" class="all_options">
		        <option value="1">One</option>
		        <option value="2">Two</option>
		        <option value="3">Three</option>
		        <option value="4">Four</option>
		        <option value="5">Five</option>
		    </select>
		    <button class="go_in">in</button>
		    <button class="go_out">out</button>
		    <select multiple="multiple" name="chosen_options" class="chosen_options">
		        <option value="7">Seven</option>
		    </select>
		    
    
		    <input type="submit" class="btn btn-primary" value="Save Page">

		    </form>

	</div>
	</div>
</div> <!-- /container -->