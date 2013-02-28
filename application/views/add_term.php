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
