<div class="container">
    <?php
    $category = explode(".", $_GET['category']);

    $conf = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . "/application/config/" . $category[0] . $category[1] . ".json");

    $jsonconf = json_decode($conf, TRUE);
    if (strcmp($category[0], "videos") == 0) {
//        echo "<div id=\"videos\">";
        echo "<table><tr style='width: 250px; height: 100px'>";
        $counter = 0;
        foreach ($jsonconf as $key => $val) {
            $counter++;

            echo "<td><a href=play.php?url=" . urlencode($val['url']) . "&title=" . urlencode($key) . ">" . "<img src=\"data/POI_logo2.png\" width=\"100px\"><br>". $key . "</a></td>";
            if ($counter == 5) {
                $counter = 0;
                echo "</tr><tr style='width: 20%; height: 100px'>";
            }
        }
        echo "</tr></table>";
    } else if (strcmp($category[0], "images") == 0) {
        require ROOT . "application/views/browse/ImageLibrary.php";
    }

    ?>
</div>
