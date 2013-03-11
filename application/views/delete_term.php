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
