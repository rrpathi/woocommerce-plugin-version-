jQuery(document).ready(function() {
	jQuery(".block").click(function(){
		var customer_id = jQuery(this).attr('id');
		jQuery.ajax({
		type:'post',
		url:ajaxurl,
		data:{
		action:"activation_key_block",
		customer_id:customer_id,
		},
		success:function(data){
			location.reload(true);
		}
		});
	});

	jQuery(".unblock").click(function(){
		var customer_id = jQuery(this).attr('id');
		var previous_key_status = jQuery(this).attr('old_status');
		jQuery.ajax({
		type:'post',
		url:ajaxurl,
		data:{
		action:"activation_key_unblock",
		customer_id:customer_id,previous_key_status:previous_key_status,
		},
		success:function(data){
			location.reload(true);
		}
		});
	});


});