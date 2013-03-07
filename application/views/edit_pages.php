<div class="container">
	<div class="row">
	<div class="span8 offset2">
		<h2>Add Page</h2>
		<?php echo validation_errors()."\n";
				echo form_open(uri_string())."\n";
		?>
		   <div class="well">
		   <label for="page_name">Page Name:</label>
		    
		    <input class="input-large" type="text" name="page_name" maxlength="90" placeholder="welcome_screen" value="<?php echo set_value('page_name');?>"><br />
		    <div class="row">
		    	<div class="span3">
		    		<label for="all_options">All Terms:</label>
		    		<?php echo form_dropdown('all_options',
		    								$terms_dropdown,
		    								'',
		    								'multiple="multiple" class="all_options input-medium"');?>
				   
				</div>
				<div class="span1">
					<br />
			    	<button class="go_in btn"><i class="icon-chevron-right"></i></button>
			    	<br /><br />
			    	<button class="go_out btn"><i class="icon-chevron-left"></i></button>
				</div>
				<div class="span3">
					<label for="chosen_options">Selected Terms:</label>
			    	<select multiple="multiple" name="chosen_options[]" class="chosen_options input-medium">
			    		
		    		</select>
		    	</div>
			</div>

			<div class="alert alert-info">
				<strong>Term Preview:</strong> <span id="preview_img"></span><span class="preview_here"></span>
			</div>
		    
    
		    <input type="submit" class="btn btn-primary" value="Save Page">
			</div>

		    </form>

	</div>
	</div>
</div> <!-- /container -->