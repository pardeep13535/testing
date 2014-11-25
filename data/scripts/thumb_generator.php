<?php
function createThumbs($pathToImages, $pathToThumbs, $thumbWidth) {
    // open the directory
    $dir = opendir($pathToImages);

    // loop through it, looking for any/all JPG files:
    while (false !== ($fname = readdir($dir))) {
        if (file_exists("{$pathToThumbs}{$fname}")) {
            continue;
        }
        $limit = ini_get('memory_limit')*0.19;
        list ($width, $height) = getimagesize("{$pathToImages}{$fname}");
        if($width*$height > $limit) {
            unlink("{$pathToImages}{$fname}");
            echo "deleted file: "."{$pathToImages}{$fname}\n";
            return;
        }


        echo "{$pathToImages}{$fname}\n";

        // parse path for the extension
        $info = pathinfo($pathToImages . $fname);
        // continue only if this is a JPEG image
        if (strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg') {
            echo ".";
//      echo "Creating thumbnail for {$fname} <br />";

            // load image and get image size
            $img = imagecreatefromjpeg("{$pathToImages}{$fname}");
            $width = imagesx($img);
            $height = imagesy($img);

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor($height * ($thumbWidth / $width));

            // create a new temporary image
            $tmp_img = imagecreatetruecolor($new_width, $new_height);

            // copy and resize old image into new image
            imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            // save thumbnail into a file
            imagejpeg($tmp_img, "{$pathToThumbs}{$fname}");
            imagedestroy($img);
            imagedestroy($tmp_img);

        }
    }
    // close the directory
    closedir($dir);
}

// call createThumb function and pass to it as parameters the path
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width.
// We are assuming that the path will be a relative path working
// both in the filesystem, and through the web for links
createThumbs("/Users/ishwar.kumar/mysite/DontPushToGit/images/", "/Users/ishwar.kumar/mysite/DontPushToGit/thumbs/", 150);
?>