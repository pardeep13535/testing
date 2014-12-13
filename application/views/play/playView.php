<div class="container">
    <?php
    require_once ROOT . "application/config/Config.php";
    $episode = $_GET['episode'];
    $index = $_GET['index'];
    require_once ROOT . "application/config/videos" . $index . ".php";
    ?>
    <diV style="height:100%">
        <div style="margin:10px">
            <iframe src="<?php echo videosURLs::$urlConfig[$episode]['url'] ?>" width="100%" height="55%"
                    frameborder="0" allowfullscreen cc="1"></iframe>
        </div>
        <div style="text-align: center;line-height: 70px;vertical-align: middle;margin:10px;color:white">
            <h2><?php echo videosURLs::$titleHead . $episode; echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $result = $sql->select("videos", Array("id" => $index . $episode), null, null, null, null, "views", null);
                echo($result["views"]);
                echo " Views"; ?></h2>
        </div>
    </diV>
</div>
<!--<div class="col-md-3"></div>-->

