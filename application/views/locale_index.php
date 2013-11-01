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
		<p><a href="<?php echo site_url('locale/add'); ?>" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add Locale</a></p>
		<table class="table sortable">
			<thead>
				<tr>
					<th>Locale ID</th>
					<th>Locale Name</th>	
					<th>Percent Complete</th>
					<th></th>				
				</tr>
			</thead>
			<tbody>
				<?php foreach($the_list as $entry):?>
				<tr class="vcenter">
					<td class="vcenter"><?php echo $entry['locale_id'];?></td>
					<td class="vcenter"><?php echo $entry['value'];?> </td>		
					<td class="vcenter"><?php echo number_format(((int)$entry['defined_terms'] / (int)$entry['total_terms']),2)*100;?>%</td>			
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