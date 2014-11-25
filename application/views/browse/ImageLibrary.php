<?php
	function random_orientation(){
		$orientation = array('&h=194&w=224', '&h=224&w=194' );
		shuffle($orientation);
		foreach($orientation as $o){
			return $o;
		}		
	};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Awesome Photo Gallery</title>
<script type="text/javascript" src="gallery/scripts/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="gallery/scripts/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript" src="gallery/scripts/jquery.mousewheel-3.0.2.pack.js"></script>
<link rel="stylesheet" type="text/css" href="gallery/scripts/fancybox/jquery.fancybox-1.3.1.css" />
<link rel="stylesheet" type="text/css" href="gallery/style.css"  />
<script>
$(document).ready(function(){
	$("a[rel=lightbox]").fancybox({
		'transitionIn'		: 'elastic',
		'transitionOut'		: 'elastic'		
	});
	//this is for the empty span tags for the magnifying glass icon
	$("ul li").append('<span></span>');
	//this is for the preloader
	
	$('img, span').hide().animate({opacity: 1.0}, 3000).fadeIn('slow'); 
	
});

</script>

</head>

<body>
<div id="wrap">

<!--<h3>Photo Gallery with Fancy Box <br /> andTimThumb Demo</h3>-->
<!--<p style="line-height:20px;">Refresh to see thumbnails dynamically generated, as well as orientation and order <br />are randomized. Click thumbnail to see Fancy box. Click <a href="">here</a> to go back to the tutorial</p>-->
<?php 
$path =  'http://' . $_SERVER['SERVER_NAME'] . '/gallery/images/'; //for local
$thumb_path =  'http://' . $_SERVER['SERVER_NAME'] . '/gallery/thumbs/'; //for local
$files = scandir(ROOT.'gallery/images/');
shuffle ($files);
?>

<ul>
<?php foreach ($files as $file){ 
	if ($file == '.' || $file == '..'){ 
		echo ''; 
	} else {	
	//assign new var to orientation
	$current_o = random_orientation();		
?>
<li <?php 	
	if ($current_o == '&h=224&w=194'){
		echo 'class="tall"';
	}?>>
<a href="<?php echo $path . $file; ?>"  rel="lightbox"><img src="<?php echo $thumb_path . $file; ?>" /></a></li>
<?php } }?>
</ul>

</div>


</body>
</html>
