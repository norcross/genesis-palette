jQuery(document).ready(function($) {
	
	// show or hide new license block licenses
	$('div.design_group input.toggle_group').click(function() {
		var name = $(this).attr('name');
		$(this).toggleClass('toggle_active');
		$('div.dg_wrap[name=' + name + ']').toggle();
	return false; 
	});	

});	