<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawVisualization);

	function drawVisualization() {
  // Create and populate the data table.
  var data = google.visualization.arrayToDataTable([
    ['x', 'Green', 'Yellow', 'Red'],
    ['1/4',   17,       42,           7],
    ["<?php echo date('n/j');?>",   <?php echo $results['heats'][1]['count'];?>,       <?php echo $results['heats'][2]['count'];?>,         <?php echo $results['heats'][3]['count'];?>]
  ]);

  // Create and draw the visualization.
  new google.visualization.LineChart(document.getElementById('reportchart')).
      draw(data, {curveType: "none",
                  colors:['green','#d7e100','red'],
                  backgroundColor:'#FFF',
                  legend: {position: 'none'},
                  width: 600, height: 350,
                  chartArea:{left:20,top:5,width:"90%",height:"90%"},
                  vAxis: {gridlines:{count:8}}}
          );
}
</script>
<div class="container">
	<div class="row">
	<div class="span12">
		<h2>Reports</h2>
	</div>
	</div>
	<div class="row">
		<div class="span5">
			<table class="table">
				<thead>
					<tr>
						<th>Heat</th>
						<th>&#37;</th>
						<th>&#35;</th>
					</tr>
				</thead>
				<tbody>
					<tr class="<?php echo $heat_color[1]['col'];?>">
						<td class="vcenter">Green</td>
						<td class="vcenter"><?php echo $results['heats'][1]['percent'];?>&#37;</td>
						<td class="vcenter"><?php echo $results['heats'][1]['count'];?></td>
					</tr>
					<tr class="<?php echo $heat_color[2]['col'];?>">
						<td class="vcenter">Yellow</td>
						<td class="vcenter"><?php echo $results['heats'][2]['percent'];?>&#37;</td>
						<td class="vcenter"><?php echo $results['heats'][2]['count'];?></td>
					</tr>
					<tr class="<?php echo $heat_color[3]['col'];?>">
						<td class="vcenter">Red</td>
						<td class="vcenter"><?php echo $results['heats'][3]['percent'];?>&#37;</td>
						<td class="vcenter"><?php echo $results['heats'][3]['count'];?></td>
					</tr>
				</tbody>
			</table>
			<br />
			<table class="table">
				<thead>
					<tr>
						<th>Call Category</th>
						<th>&#35;</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="vcenter">Support</td>
						<td class="vcenter"><?php echo $results['tiks']['support'];?></td>
					</tr>
					<tr>
						<td class="vcenter">Product Development</td>
						<td class="vcenter"><?php echo $results['tiks']['proddev'];?></td>
					</tr>
					<tr>
						<td class="vcenter">Enhancements</td>
						<td class="vcenter"><?php echo $results['tiks']['enh'];?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="span7">
			<div id="reportchart"></div>
		</div>
	</div>
	<div class="row">
	<div class="span12">
		<h2>Hot Sites</h2>
		<table class="table sortable">
			<thead>
				<tr>
					<th>Heat</th>
					<th>Sitecode</th>
					<th class="hidden-phone">Contact</th>
					<th class="hidden-phone">Last Updated</th>
					<th>How Long @ Red</th>
					<th>Comments</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($the_list as $entry):?>
				<tr class="<?php echo $heat_color[$entry['heat']]['col'];?>">
					<td class="vcenter"><span class="hide"><?php echo $entry['heat'];?></span><?php echo $heat_color[$entry['heat']]['label'];?></td>
					<td class="vcenter"><a href="<?php echo site_url().'heat/view/'.$entry['sitecode']; ?>"><?php echo $entry['sitecode'];?></a></td>
					<td class="vcenter hidden-phone"><?php echo $entry['contact_person'];?></td>					
					<td class="vcenter hidden-phone"><?php echo $entry['last_updated'];?></td>
					<td class="vcenter hidden-phone"><?php echo ($results['red'][$entry['sitecode']]['interval']);?></td>
					<td class="vcenter"><?php echo $entry['comments'];?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<div style="text-align:center;"><a href="http://insight.iii.com/TSD" title="TSD Technology Badge" style="border:none"><img src="http://innhouse.iii.com/tsd/branding/tsd_technology.png" width="80" height="15" border="0" /></a></div>
	</div>
	</div>
</div> <!-- /container -->
<script type="text/javascript" src="<?php echo site_url(); ?>/css/sorttable.js"></script>
</body>
</html>