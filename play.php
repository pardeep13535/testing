<?php
require_once "application/config/Config.php";
include "application/views/_templates/header.php" ?>

<head></head>
<div >
<iframe src="<?php echo urldecode($_GET['url']) ?>" width="60%" height="60%" frameborder="0" allowfullscreen cc="1"></iframe>
 </div>
<div style="width:60%;height:50px;background-color: #ffffff;text-align: center;line-height: 50px;vertical-align: middle">
<h2><?php echo urldecode($_GET['title']) ?></h2>
</div>
</html>