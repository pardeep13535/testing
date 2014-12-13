<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class play extends Controller {
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index() {
        // load views
        require_once APP. "core/MySQL.php";
        require APP . 'views/_templates/header.php';

        // Get the category from url get param and load corresponding config and display those images.

        $videoID = $_GET['index'] . $_GET['episode'];
        $sql = new MySQL();
        $sql->increment("videos", "views", $videoID);
        require APP . 'views/play/playView.php';

        require APP . 'views/_templates/footer.php';
    }
}
