<?php
require_once "application/config/Config.php";
include "application/views/_templates/header.php";
$episode=$_GET['episode'];
$classToInclude="videos".$_GET['index'];
require_once "application/config/".$classToInclude.".php";
?>

<head></head>
<div style="margin:10px">
	<div >
		<iframe src="<?php echo videosURLs::$urlConfig[$episode]['url'] ?>" width="100%" height="55%" frameborder="0" allowfullscreen cc="1"></iframe>
	</div>
		<div style="height:30px;background-color: #ffffff;text-align: center;line-height: 70px;vertical-align: middle;margin:10px">
		<h2 ><?php echo videosURLs::$titleHead.$episode ?></h2>
	</div>
</div>
</html>
