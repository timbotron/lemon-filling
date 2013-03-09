</body>

<script src="<?php echo site_url('/js/jquery-1.9.1.min.js');?>"></script>
<script src="<?php echo site_url('/js/sorttable.js');?>"></script>
<script type="text/javascript">
// Caching imgs
var load_gfx = new Image();
load_gfx.src = "<?php echo site_url();?>/img/loading.gif";
var load_gfx1 = new Image();
load_gfx1.src = "<?php echo site_url();?>/img/glyphicons-halflings.png";
var load_gfx2 = new Image();
load_gfx2.src = "<?php echo site_url();?>/img/glyphicons-halflings-white.png";

$("#viewing_lang").change(function() {
	//alert('bam!');
	window.location.href="<?php echo site_url($this->uri->segment(1).'/view/');?>/"+$(this).val();
	});
$("#define_lang").change(function() {
	//alert('bam!');
	window.location.href="<?php echo site_url($this->uri->segment(1).'/bulk_edit/');?>/"+$(this).val();
	});
$(".define_box").change(function() {
		//alert('unfocused! content is: '+$(this).text());
		//working on submitting, so add cog
		var $id=$(this).attr('id');
		//$("#"+$id+"_img").html('<img src="<?php echo site_url();?>/img/loading.gif">');
		load_imgs($id,'loading');
		 $.post('<?php echo site_url("/terms/update");?>',
					{id:$id,content:$(this).val()},
					function(data)
					{
						var result = data;
						load_imgs($id,result.status);
					});
		// <i class="icon-cog icon"></i>
	});
$('.go_in').click(function() {
	$('.preview_here').text('');
    return !$('.all_options option:selected').remove().appendTo('.chosen_options');
});
$('.go_out').click(function() {
	$('.preview_here').text('');
   return !$('.chosen_options option:selected').remove().appendTo('.all_options'); 
});
$('.all_options').change(function() {	
	$('.preview_here').text('');
	$('option:selected',this).each(function() {
		console.log('boosh');
		$.ajax({
			dataType:'json',
			url: '<?php echo site_url("/terms/json_view");?>'+"/"+$(this).val(),
			data: '',
			success: function(data)
			{
				console.log(data.value);
				$('.preview_here').append(data.value+" | ");
			}
		})
	});

});
$('.pages_view').click(function() {
	var the_dad = $(this).parent();
	if(the_dad.children('.icon-minus').length>0)
	{
		the_dad.children('.icon-minus').remove();
		the_dad.parent().next('.details').remove();
	}
	else
	{
		$(this).after(' <img class="loading" src="<?php echo site_url();?>/img/loading.gif">');
		the_dad.prepend('<i class="icon-minus"></i>');
		$.ajax({
			dataType:'json',
			url: '<?php echo site_url("/pages/json/");?>'+"/"+$(this).text()+"/"+'<?php echo $first_locale["locale_id"];?>',
			data: '',			
			success: function(data)
			{
				var output = "\n"+'<tr class="details"><td colspan="2"><table class="table table-condensed table-bordered"><thead><tr><th>Terms</th><th>Value</th></tr></thead><tbody>';
				
				for(var key in data)
				{
					output += "\n"+'<tr><td>'+key+'</td><td>'+data[key]+'</td></tr>';
				}
				output += "\n</tbody></table></td></tr>";
				the_dad.parent().after(output);
				the_dad.children('.loading').remove();

			}
		})

	}

});
 
$('form').submit(function() {
    $('.all_options option').prop('selected','');
    $('.chosen_options option').prop('selected','selected');
    //alert($(this).serialize());
});
function load_imgs($passedid,$type)
{
	if($type=='loading')
	{
		$("#"+$passedid+"_img").html('<img src="<?php echo site_url();?>/img/loading.gif">');	
	} 
	else if($type=='done')
	{
		$("#"+$passedid+"_img").html('');	
	} 
	else if($type=='load_txt')
	{
		$("#"+$passedid+"_img").html('Loading...');	
	}
	else if($type=='success')
	{
		$("#"+$passedid+"_img").html('<i class="icon-ok"></i>').fadeOut(3000);
	}
	else if($type=='error')
	{
		$("#"+$passedid+"_img").html('<i class="icon-warning-sign"></i>')
	}
}


</script>
</html>