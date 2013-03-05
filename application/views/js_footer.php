</body>

<script src="<?php echo site_url('/js/jquery-1.9.1.min.js');?>"></script>
<script src="<?php echo site_url('/js/sorttable.js');?>"></script>
<script type="text/javascript">
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
						console.log(data);
						var result = $.parseJSON(data);
						load_imgs($id,result.status);
					});
		// <i class="icon-cog icon"></i>
	});
$('.go_in').click(function() {
    return !$('.all_options option:selected').remove().appendTo('.chosen_options');
});
$('.go_out').click(function() {
   return !$('.chosen_options option:selected').remove().appendTo('.all_options'); 
});
$('.all_options').change(function() {
	$('option:selected',this).each(function() {
		console.log('boosh');
		$.ajax({
			dataType:'json',
			url: '<?php echo site_url("/terms/json_view");?>'+"/"+$(this).val(),
			data: '',
			success: function(data)
			{
				console.log(data);
				var result = $.parseJSON(data);
				$('.preview_here').text(result.value);
			}
		})
	});
});
 
$('form').submit(function() {
    $('.all_options option').prop('selected','');
    $('.chosen_options option').prop('selected','selected');
    alert($(this).serialize());
});
function load_imgs($passedid,$type)
{
	if($type=='loading')
	{
		$("#"+$passedid+"_img").html('<img src="<?php echo site_url();?>/img/loading.gif">');	
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