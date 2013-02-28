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
