<div class="container">
	<div class="row">
	<div class="offset3 span6">		   
		<p><a href="<?php echo site_url('locale/add'); ?>" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add Locale</a></p>
		<table class="table sortable">
			<thead>
				<tr>
					<th>Locale ID</th>
					<th>Locale Name</th>	
					<th></th>				
				</tr>
			</thead>
			<tbody>
				<?php foreach($the_list as $entry):?>
				<tr class="vcenter">
					<td class="vcenter"><?php echo $entry['locale_id'];?></td>
					<td class="vcenter"><?php echo $entry['value'];?></td>					
					<td class="vcenter"><a href="<?php echo site_url("locale/edit/".$entry['locale_id']); ?>" class="btn btn-small btn-warning pull-right"><i class="icon-edit icon-white"></i></a></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
	</div>
</div> <!-- /container -->
</body>
</html>