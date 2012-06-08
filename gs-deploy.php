<?php

function gsd_custom_css() {

	// font stacks
	// stacks from Chris Coyier  http://css-tricks.com/snippets/css/font-stacks/
	$timesnew	= 'Cambria, "Hoefler Text", Utopia, "Liberation Serif", "Nimbus Roman No9 L Regular", Times, "Times New Roman", serif';
	$georgia	= 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", Georgia, serif';
	$garamond	= '"Palatino Linotype", Palatino, Palladio, "URW Palladio L", "Book Antiqua", Baskerville, "Bookman Old Style", "Bitstream Charter", "Nimbus Roman No9 L", Garamond, "Apple Garamond", "ITC Garamond Narrow", "New Century Schoolbook", "Century Schoolbook", "Century Schoolbook L", Georgia, serif';
	$helvetica	= 'Frutiger, "Frutiger Linotype", Univers, Calibri, "Gill Sans", "Gill Sans MT", "Myriad Pro", Myriad, "DejaVu Sans Condensed", "Liberation Sans", "Nimbus Sans L", Tahoma, Geneva, "Helvetica Neue", Helvetica, Arial, sans-serif';
	$verdana	= 'Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", "Bitstream Vera Sans", "Liberation Sans", Verdana, "Verdana Ref", sans-serif';
	$trebuchet	= '"Segoe UI", Candara, "Bitstream Vera Sans", "DejaVu Sans", "Bitstream Vera Sans", "Trebuchet MS", Verdana, "Verdana Ref", sans-serif';
	$impact		= 'Impact, Haettenschweiler, "Franklin Gothic Bold", Charcoal, "Helvetica Inserat", "Bitstream Vera Sans Bold", "Arial Black", sans-serif';


	// design settings array
	$gs_design	= get_option('gs-settings');
	
	// background
	$body_bg	= $gs_design['body_bg'];
	$wrap_bg	= $gs_design['wrap_bg'];
	$head_bg	= $gs_design['head_bg'];
	$navi_bg	= $gs_design['navi_bg'];
	$innr_bg	= $gs_design['innr_bg'];
	$side_bg	= $gs_design['side_bg'];
	$foot_bg	= $gs_design['foot_bg'];
	
	// text
	$body_text	= $gs_design['body_text'];
	$head_text	= $gs_design['head_text'];
	$desc_text	= $gs_design['desc_text'];
	$post_text	= $gs_design['post_text'];
	$meta_text	= $gs_design['meta_text'];
	$side_text	= $gs_design['side_text'];
	$widg_text	= $gs_design['side_text'];
	$foot_text	= $gs_design['foot_text'];

	// links
	$body_link	= $gs_design['body_link'];
	$navi_link	= $gs_design['navi_link'];
	$meta_link	= $gs_design['meta_link'];
	$widg_link	= $gs_design['widg_link'];	
	$foot_link	= $gs_design['foot_link'];

	// hover
	$body_hover	= $gs_design['body_hover'];
	$head_hover	= $gs_design['head_hover'];
	$navi_hover	= $gs_design['navi_hover'];
	$post_hover	= $gs_design['post_hover'];
	$meta_hover	= $gs_design['meta_hover'];
	$widg_hover	= $gs_design['widg_hover'];	
	$foot_hover	= $gs_design['foot_hover'];

	// borders
	$wrap_bord	= $gs_design['wrap_bord'];
	$navi_bord	= $gs_design['navi_bord'];
	$widg_bord	= $gs_design['widg_bord'];
	$list_bord	= $gs_design['list_bord'];
	$foot_bord	= $gs_design['foot_bord'];
		
	// font stacks
	$body_font	= $gs_design['body_font'];
	$head_font	= $gs_design['head_font'];
	$desc_font	= $gs_design['desc_font'];
	$navi_font	= $gs_design['navi_font'];
	$post_font	= $gs_design['post_font'];
	$meta_font	= $gs_design['meta_font'];
	$side_font	= $gs_design['side_font'];
	$widg_font	= $gs_design['widg_font'];
	$foot_font	= $gs_design['foot_font'];
	
	// body fonts
	if ($body_font == '1') $body_stack = $timesnew;
	if ($body_font == '2') $body_stack = $georgia;
	if ($body_font == '3') $body_stack = $garamond;
	if ($body_font == '4') $body_stack = $helvetica;
	if ($body_font == '5') $body_stack = $trebuchet;
	if ($body_font == '6') $body_stack = $verdana;
	if ($body_font == '7') $body_stack = $impact;
	if (empty($body_font)) $body_stack = '"Helvetica Neue",Arial,Helvetica,sans-serif';
		
	// site title stack
	if ($head_font == '1') $head_stack = $timesnew;
	if ($head_font == '2') $head_stack = $georgia;
	if ($head_font == '3') $head_stack = $garamond;
	if ($head_font == '4') $head_stack = $helvetica;
	if ($head_font == '5') $head_stack = $trebuchet;
	if ($head_font == '6') $head_stack = $verdana;
	if ($head_font == '7') $head_stack = $impact;
	if (empty($head_font)) $head_stack = '"Oswald",arial,serif';
		
	// site desc stack
	if ($desc_font == '1') $desc_stack = $timesnew;
	if ($desc_font == '2') $desc_stack = $georgia;
	if ($desc_font == '3') $desc_stack = $garamond;
	if ($desc_font == '4') $desc_stack = $helvetica;
	if ($desc_font == '5') $desc_stack = $trebuchet;
	if ($desc_font == '6') $desc_stack = $verdana;
	if ($desc_font == '7') $desc_stack = $impact;
	if (empty($desc_font)) $desc_stack = '"Helvetica Neue",Arial,Helvetica,sans-serif';

	// site desc stack
	if ($navi_font == '1') $navi_stack = $timesnew;
	if ($navi_font == '2') $navi_stack = $georgia;
	if ($navi_font == '3') $navi_stack = $garamond;
	if ($navi_font == '4') $navi_stack = $helvetica;
	if ($navi_font == '5') $navi_stack = $trebuchet;
	if ($navi_font == '6') $navi_stack = $verdana;
	if ($navi_font == '7') $navi_stack = $impact;
	if (empty($navi_font)) $navi_stack = '"Helvetica Neue",Arial,Helvetica,sans-serif';

	// post title stack
	if ($post_font == '1') $post_stack = $timesnew;
	if ($post_font == '2') $post_stack = $georgia;
	if ($post_font == '3') $post_stack = $garamond;
	if ($post_font == '4') $post_stack = $helvetica;
	if ($post_font == '5') $post_stack = $trebuchet;
	if ($post_font == '6') $post_stack = $verdana;
	if ($post_font == '7') $post_stack = $impact;
	if (empty($post_font)) $post_stack = '"Oswald",arial,serif';

	// post meta stack
	if ($meta_font == '1') $meta_stack = $timesnew;
	if ($meta_font == '2') $meta_stack = $georgia;
	if ($meta_font == '3') $meta_stack = $garamond;
	if ($meta_font == '4') $meta_stack = $helvetica;
	if ($meta_font == '5') $meta_stack = $trebuchet;
	if ($meta_font == '6') $meta_stack = $verdana;
	if ($meta_font == '7') $meta_stack = $impact;
	if (empty($meta_font)) $meta_stack = '"Helvetica Neue",Arial,Helvetica,sans-serif';

	// widget title stack
	if ($side_font == '1') $side_stack = $timesnew;
	if ($side_font == '2') $side_stack = $georgia;
	if ($side_font == '3') $side_stack = $garamond;
	if ($side_font == '4') $side_stack = $helvetica;
	if ($side_font == '5') $side_stack = $trebuchet;
	if ($side_font == '6') $side_stack = $verdana;
	if ($side_font == '7') $side_stack = $impact;
	if (empty($side_font)) $side_stack = '"Oswald",arial,serif';

	// widget text stack
	if ($widg_font == '1') $widg_stack = $timesnew;
	if ($widg_font == '2') $widg_stack = $georgia;
	if ($widg_font == '3') $widg_stack = $garamond;
	if ($widg_font == '4') $widg_stack = $helvetica;
	if ($widg_font == '5') $widg_stack = $trebuchet;
	if ($widg_font == '6') $widg_stack = $verdana;
	if ($widg_font == '7') $widg_stack = $impact;
	if (empty($widg_font)) $widg_stack = '"Helvetica Neue",Arial,Helvetica,sans-serif';

	// footer title stack
	if ($foot_font == '1') $foot_stack = $timesnew;
	if ($foot_font == '2') $foot_stack = $georgia;
	if ($foot_font == '3') $foot_stack = $garamond;
	if ($foot_font == '4') $foot_stack = $helvetica;
	if ($foot_font == '5') $foot_stack = $trebuchet;
	if ($foot_font == '6') $foot_stack = $verdana;
	if ($foot_font == '7') $foot_stack = $impact;
	if (empty($foot_font)) $foot_stack = '"Helvetica Neue",Arial,Helvetica,sans-serif';

	// font sizes
	$body_size	= $gs_design['body_size'];
	$head_size	= $gs_design['head_size'];
	$desc_size	= $gs_design['desc_size'];
	$navi_size	= $gs_design['navi_size'];
	$post_size	= $gs_design['post_size'];
	$meta_size	= $gs_design['meta_size'];
	$side_size	= $gs_design['side_size'];
	$widg_size	= $gs_design['widg_size'];
	$foot_size	= $gs_design['foot_size'];
	
	// font weight
	$body_weight	= $gs_design['body_weight'];
	$head_weight	= $gs_design['head_weight'];
	$desc_weight	= $gs_design['desc_weight'];
	$navi_weight	= $gs_design['navi_weight'];
	$post_weight	= $gs_design['post_weight'];
	$side_weight	= $gs_design['side_weight'];
	$widg_weight	= $gs_design['widg_weight'];
	$foot_weight	= $gs_design['foot_weight'];

	// transforms
	$head_caps	= $gs_design['head_caps'];
	$desc_caps	= $gs_design['desc_caps'];
	$post_caps	= $gs_design['post_caps'];
	$widg_caps	= $gs_design['widg_caps'];

	// content headers
	$cont_h1	= $gs_design['cont_h1'];
	$cont_h2	= $gs_design['cont_h2'];
	$cont_h3	= $gs_design['cont_h3'];
	$cont_h4	= $gs_design['cont_h4'];
	$cont_h5	= $gs_design['cont_h5'];
	$cont_h6	= $gs_design['cont_h6'];
		
	// begin CSS printing
	$gsd_css = '

	/* General */	

.gs-custom a, .gs-custom a:visited {
    color: '.$body_link.';
}

.gs-custom a:hover, .gs-custom a:focus {
    color: '.$body_hover.';
}

	/* Body */

body.gs-custom, 
.gs-custom p {
	font-family: '.$body_stack.';
	font-size: '.$body_size.';
	font-weight: '.$body_weight.';
	color: '.$body_text.';
	}

body.gs-custom {
	background-color: '.$body_bg.';
}

.gs-custom #wrap {
	-moz-box-shadow: 0 0 5px '.$wrap_bord.';
	-webkit-box-shadow: 0 0 5px '.$wrap_bord.';
	box-shadow: 0 0 5px '.$wrap_bord.';
}

.gs-custom #inner {
	background-color: '.$innr_bg.';
}

	/* Header Area */
	
.gs-custom #header {
	background-color: '.$head_bg.';
}

.gs-custom #title {
	font-family: '.$head_stack.';
	font-size: '.$head_size.';
	font-weight: '.$head_weight.';
	text-transform: '.$head_caps.';
    color: '.$head_text.';
}

.gs-custom #title a {
    color: '.$head_text.';
}

.gs-custom #title a:hover,
.gs-custom #title a:focus {
    color: '.$head_hover.';
}

.gs-custom #description {
	font-family: '.$desc_stack.';
	font-size: '.$desc_size.';
	font-weight: '.$desc_weight.';
	text-transform: '.$desc_caps.';
    color: '.$desc_text.';
}

	/* Navigation */

.gs-custom .menu-primary {
    border-bottom: 1px solid '.$navi_bord.';
    border-top: 1px solid '.$navi_bord.';
    background-color: '.$navi_bg.';
	font-family: '.$navi_stack.';
	font-size: '.$navi_size.';
	font-weight: '.$navi_weight.';
}

.gs-custom .menu-primary a {
    color: '.$navi_link.';
    border-right: 1px solid '.$navi_bord.';
}

.gs-custom .menu-primary a:hover,
.gs-custom .menu-primary a:focus {
    color: '.$navi_hover.';
}

	/* Post Titles */

.gs-custom .post h2.entry-title,
.gs-custom .post h2.entry-title a,
.gs-custom .post h1.entry-title,
.gs-custom .page h1.entry-title {
	font-family: '.$post_stack.';
	font-size: '.$post_size.';
	font-weight: '.$post_weight.';
	color: '.$post_text.';
}

.gs-custom .post h2.entry-title a:hover,
.gs-custom .post h2.entry-title a:focus {
	color: '.$post_hover.';
}

	/* Post Meta */

.gs-custom .post-info {
	font-family: '.$meta_stack.';
	font-size: '.$meta_size.';
	color: '.$meta_text.';	
}

.gs-custom .post-info a, 
.gs-custom .post-info a:visited {
	color: '.$meta_link.';	
}

.gs-custom .post-info a:hover, 
.gs-custom .post-info a:focus {
	color: '.$meta_hover.';	
}

	/* Post Content */

.gs-custom .entry-content h1 {font-size: '.$cont_h1.';}
.gs-custom .entry-content h2 {font-size: '.$cont_h2.';}
.gs-custom .entry-content h3 {font-size: '.$cont_h3.';}
.gs-custom .entry-content h4 {font-size: '.$cont_h4.';}
.gs-custom .entry-content h5 {font-size: '.$cont_h5.';}
.gs-custom .entry-content h6 {font-size: '.$cont_h6.';}

	/* Widgets */

.gs-custom .sidebar .widget {
    border: 1px solid '.$widg_bord.';
}

.gs-custom .widget-area h4 {
	font-family: '.$side_stack.';
	font-size: '.$side_size.';
	font-weight: '.$side_weight.';
    background-color: '.$side_bg.';
    border-bottom: 1px solid '.$widg_bord.';
	color:'.$side_text.';
}

.gs-custom .sidebar p,
.gs-custom .sidebar ul,
.gs-custom .sidebar li {
	font-family: '.$widg_stack.';
	font-size: '.$widg_size.';
	font-weight: '.$widg_weight.';
	color:'.$widg_text.';
}

.gs-custom .sidebar .widget-area ul li, 
.gs-custom #footer-widgets .widget-area ul li {
    border-bottom: 1px solid '.$list_bord.';
}

.gs-custom .sidebar p a,
.gs-custom .sidebar p a:visited,
.gs-custom .sidebar ul a,
.gs-custom .sidebar ul a:visited,
.gs-custom .sidebar li a,
.gs-custom .sidebar li a:visited {
	color:'.$widg_link.';
}

.gs-custom .sidebar p a:hover,
.gs-custom .sidebar p a:focus,
.gs-custom .sidebar ul a:hover,
.gs-custom .sidebar ul a:focus,
.gs-custom .sidebar li a:hover,
.gs-custom .sidebar li a:focus {
	color:'.$widg_hover.';
}
		

	/* Footer */
	
.gs-custom #footer {
    background-color: '.$foot_bg.';
	border-top: 1px solid '.$foot_bord.';
	font-size: '.$foot_size.';
}

.gs-custom #footer p {
    color: '.$foot_text.';
}

.gs-custom #footer a, 
.gs-custom #footer a:visited {
    color: '.$foot_link.';
}

.gs-custom #footer a:hover, 
.gs-custom #footer a:focus {
    color: '.$foot_hover.';
}

';

return $gsd_css;
}
	
function gsd_generate_css() {
	// get the new CSS
	$gsd_css_data	= gsd_custom_css();
	// open the custom.css file
	$gsd_css_file	= GS_PLUGIN_DIR.'/css/gs-custom.css';
	$fh = @fopen($gsd_css_file, 'wb') or die( 'Whoops. Looks like your plugin folder is not writable.');
	$gsd_css_write	= ''.$gsd_css_data.'\n';
	fwrite($fh, $gsd_css_write);
	fclose($fh);
}