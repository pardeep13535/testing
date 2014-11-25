<script>
    function getElementLeft(elm) {
        var x = 0;

        //set x to elm’s offsetLeft
        x = elm.offsetLeft;

        //set elm to its offsetParent
        elm = elm.offsetParent;

        //use while loop to check if elm is null
        // if not then add current elm’s offsetLeft to x
        //offsetTop to y and set elm to its offsetParent

        while (elm != null) {
            x = parseInt(x) + parseInt(elm.offsetLeft);
            elm = elm.offsetParent;
        }
        return x;
    }

    function getElementTop(elm) {
        var y = 0;

        //set x to elm’s offsetLeft
        y = elm.offsetTop;

        //set elm to its offsetParent
        elm = elm.offsetParent;

        //use while loop to check if elm is null
        // if not then add current elm’s offsetLeft to x
        //offsetTop to y and set elm to its offsetParent

        while (elm != null) {
            y = parseInt(y) + parseInt(elm.offsetTop);
            elm = elm.offsetParent;
        }

        return y;
    }

    function Large(obj) {
        var imgbox = document.getElementById("imgbox");
        var img = document.createElement("img");
        imgbox.style.visibility = "visible";
        img.src = obj.src;

//        if(img.addEventListener){
//            img.addEventListener('mouseout',Out,false);
//        } else {
//            img.attachEvent('onmouseout',Out);
//        }

        imgbox.innerHTML = '';
        imgbox.appendChild(img);

        $("#allImages").hide();
        $("#header").hide();

    }
</script>

<div class="container">
    <?php
    $category = explode(".", $_GET['category']);

    $conf = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . "/application/config/" . $category[0] . ".json");

    $jsonconf = json_decode($conf, TRUE);
    if (strcmp($category[0], "videos") == 0) {
        echo "<div id=\"videos\">";
        foreach ($jsonconf as $key => $val) {
            echo "<iframe src=\"" . $val["url"] . "\"" . "width=\"150\" height=\"150\">";
//            echo $key;
            echo "</iframe>";
            echo "<p>".$key."</p>";
        }
        echo "</div>";
    } else if (strcmp($category[0], "images") == 0) {
        require ROOT."application/views/browse/ImageLibrary.php";
        // ?category=".$category[1];

//        echo "<div id=\"images\">";
//        foreach ($jsonconf as $title => $links) {
//            echo "<a href=\"" . $links["url"] . "\">";
//            echo "<img src=\"" . $links["thumb"] . "\" style=\"width: 150px; height: 150px\">";
//            echo $title . "</a>";
//        }
//        echo "</div>";
    }

    ?>
</div>


<!---->
<!--    <div>-->
<!--        <iframe src="https://drive.google.com/file/d/0BxaT3xbG4soISnNoa2tyX0xuZWc/preview" width="150"-->
<!--                height="150"></iframe>-->
<!--        <iframe src="https://docs.google.com/file/d/0BxaT3xbG4soINzlsTXpGa3pIX3M/preview" width="150"-->
<!--                height="150"></iframe>-->
<!--        <iframe src="https://drive.google.com/file/d/0BxaT3xbG4soISnNoa2tyX0xuZWc/preview" width="150"-->
<!--                height="150"></iframe>-->
<!--        <iframe src="https://docs.google.com/file/d/0BxaT3xbG4soINzlsTXpGa3pIX3M/preview" width="150"-->
<!--                height="150"></iframe>-->
<!--        <iframe src="https://drive.google.com/file/d/0BxaT3xbG4soISnNoa2tyX0xuZWc/preview" width="150"-->
<!--                height="150"></iframe>-->
<!--        <iframe src="https://docs.google.com/file/d/0BxaT3xbG4soINzlsTXpGa3pIX3M/preview" width="150"-->
<!--                height="150"></iframe>-->
<!--        <iframe src="https://drive.google.com/file/d/0BxaT3xbG4soISnNoa2tyX0xuZWc/preview" width="150"-->
<!--                height="150"></iframe>-->
<!--        <iframe src="https://docs.google.com/file/d/0BxaT3xbG4soINzlsTXpGa3pIX3M/preview" width="150"-->
<!--                height="150"></iframe>-->
<!---->
<!--    </div>-->

<!--div id="allImages">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">
    <img src="http://www.wired.com/wp-content/uploads/2014/10/Lamborghini-Asterion-04.jpg"
         style="width: 150px; height: 150px" onclick="Large(this)">
    <img
        src="https://s.yimg.com/os/publish-images/autos/2014-10-02/1bb19190-4a18-11e4-a6e8-e52abde8a31d_Lamborghini-Asterion-Concept-top2.jpg"
        style="width: 150px; height: 150px" onclick="Large(this)">

</div>
<div id="imgbox"></div-->
<!--</div>-->
