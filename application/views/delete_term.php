<div class="container">
	<div class="row">
	<div class="offset3 span6">

		    <form class="form-horizontal well">
        <fieldset>     
        <div class="control-group">          
          <div class="controls">
            <h3>Delete Term:<br /> <?php echo $term['value'];?></h3>
          </div>
        </div>  
                <div class="alert alert-error">                
                <h4 class="alert-heading">Warning!</h4>
                This will delete the term, and all definitions of that term. It will also be removed from any pages it is associated with.<br /> There are currently <strong><?php echo $term['the_count']; ?></strong> definitions defined to this term. This cannot be undone.
                </div>     
         
        <div class="control-group">
          <div class="controls">
            <a href="<?php echo site_url('terms'); ?>" class="btn">Cancel</a>
             <a href="<?php echo site_url('terms/delete/'.$this->uri->segment(3).'/confirmed'); ?>" class="btn btn-danger">Delete Term</a>            
          </div>
        </div>
                  
      </fieldset>
      </form>

	</div>
	</div>
</div> <!-- /container -->

</body>
</html>
