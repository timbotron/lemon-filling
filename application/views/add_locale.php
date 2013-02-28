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
