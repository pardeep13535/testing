<div class="container">
    <?php
    $category = explode(".", $_GET['category']);

    $file = ROOT . "/application/config/" . $category[0] . $category[1] . ".php";
    if (file_exists($file)) {
        require_once $file;
        echo "<table><tr style='width: 250px; height: 100px'>";
        $counter = 0;
        foreach (videosURLs::$urlConfig as $key => $val) {
            if(strcasecmp(substr($key,0,3), $category[2]) != 0) continue;
            $counter++;

            echo "<td align='center'><a href=play.php?episode=" . $key . "&index=". videosURLs::$index . ">" . "<img src=\"data/".$category[1]."_logo.jpg\" width=\"100px\"><br>". videosURLs::$titleHead. $key . "</a></td>";
            if ($counter == 3) {
                $counter = 0;
                echo "</tr><tr style='width: 20%; height: 100px'>";
            }
        }
        echo "</tr></table>";
    } else {
        include_once ROOT . '/application/views/error/index.php';
    }

    ?>
</div>
