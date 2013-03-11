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
	<div class="offset1 span10">
		<h2>Editing Definitions</h2>
		<p class="muted">Chosen Language: <?php echo $locale_dropdown[$this->uri->segment(3)];?></p>

		
		<table class="table sortable">
			<thead>
				<tr>
					<th>Term Key</th>
					<th><?php echo $locale_dropdown[$def_lang];?> Definition</th>	
					<th><?php echo $locale_dropdown[$this->uri->segment(3)];?> Definition</th>			
					<th><span class="hideme">##</span></th>		
				</tr>
			</thead>
			<tbody>
				<?
					foreach($the_list['default_terms'] as $key => $value)
					{
						printf('<tr><td><a name="%s"></a>%s</td><td>%s</td>',$the_list['locale_terms'][$key]['rosetta_id'],$value['terms_value'],$value['rosetta_value']);
						echo '<td><textarea rows="3" class="input-xlarge define_box" id="'.$value['terms_id']."_".$this->uri->segment(3).'" >'.$the_list['locale_terms'][$key]['rosetta_value'].'</textarea></td><td class="vcenter"><span id="'.$value['terms_id']."_".$this->uri->segment(3).'_img"></span></tr>'."\n";
					}

				?>
				
			</tbody>
		</table>
	</div>
	</div>
</div> <!-- /container -->
