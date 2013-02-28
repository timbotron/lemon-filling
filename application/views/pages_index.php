<div class="container">
	<div class="row">
	<div class="offset4 span4">	
		<p><a href="<?php echo site_url('pages/add'); ?>" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add Page</a></p>
		
		<table class="table sortable">
			<thead>
				<tr>
					<th>Page Name</th>
					<th></th>				
				</tr>
			</thead>
			<tbody>
				<?
					foreach($the_list as $value)
					{
						printf('<tr><td><a href="%s">%s</a></td><td><a href="%s" class="btn btn-small btn-warning pull-right"><i class="icon-edit icon-white"></i></a>',site_url('pages/view/'.$value['page_id']),$value['value'],site_url('/pages/edit/'.$value['page_id']));
					}

				?>
				
			</tbody>
		</table>
	</div>
	</div>
</div> <!-- /container -->
