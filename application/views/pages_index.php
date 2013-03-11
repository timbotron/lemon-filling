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
						printf('<tr><td><a href="%s" class="pages_view">%s</a></td><td><a href="%s" class="btn btn-small btn-warning pull-right"><i class="icon-edit icon-white"></i></a></td></tr>'."\n","javascript:void(0);",$value['value'],site_url('/pages/edit/'.$value['page_id']));
					}

				?>
			</tbody>
		</table>
	</div>
	</div>
</div> <!-- /container -->
