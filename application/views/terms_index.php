<div class="container">
	<div class="row">
	<div class="offset1 span10">	
		<div class="row">
			<div class="span2">	   
				<p><a href="<?php echo site_url('terms/add')."/".$this->uri->segment(3); ?>" class="btn btn-primary btn-small"><i class="icon-plus icon-white"></i> Add Term(s)</a></p>
			</div>
			<div class="span3"> 
				<form class="form-inline">
					<label for="lang">Viewing: </label>
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
				</form>
			</div>
			<div class="span5"> 
				<form class="form-inline">
					<label for="define_lang">Add localized terms to: </label>
					<select class ="input-medium" id="define_lang" name="define_lang">
						<option value="0">Choose..</option>
						<?php 
						foreach($locale_dropdown as $key => $option)
						{							
							printf('<option value="%s">%s</option>',$key,$option);						
						}
						?>
					</select> 
				</form>
			</div>
		</div>
		
		<table class="table sortable">
			<thead>
				<tr>
					<th></th>				
					<th>Term Key</th>
					<th>Definition</th>	
					<th></th>				
				</tr>
			</thead>
			<tbody>
				<?
					foreach($the_list as $value)
					{
						printf('<tr><td><a href="%s" class="btn btn-mini btn-danger"><i class="icon-remove-circle icon-white"></i></a></td><td>%s</td><td>%s</td><td><a href="%s" class="btn btn-small btn-warning pull-right"><i class="icon-edit icon-white"></i></a>',site_url('terms/delete/'.$value['terms_id']),$value['terms_value'],$value['rosetta_value'],site_url('/terms/bulk_edit/'.$this->uri->segment(3).'#'.$value['rosetta_id']));
					}

				?>
				
			</tbody>
		</table>
	</div>
	</div>
</div> <!-- /container -->
