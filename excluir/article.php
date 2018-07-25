<?php
try {
//Require Pages
    require_once("../php/session.php");
    require_once("../php/class.user.php");
    
    require_once('../database.connection.php');
    require_once('../forum.class.php');

//Coleta Forum
    $forums = new Forum($dbh);
    $errors = array();
    ob_start('ob_gzhandler');
    $forum_main = $forums->getForum();
    $topics = $forums->getTopics($_GET['article-id']);


//Consults DataBase
    $activeDB = new USER();

//Collect from URL
    $article_tag = str_replace('-', '%', $_GET['article']);

    $article_id = $_GET['article-id'];
    
    //$article_tag = str_replace("'", "\'", $article_tag);
    $search_article_tag = json_encode($article_tag);
    // $article_tag = str_replace('%3A', ':', $article_tag);

    $tagBanner = str_replace(' ', '+', $article_tag);

//Collects Article Info
    $sql = "SELECT * FROM article where article_id LIKE '$article_id'";
    $result = $activeDB->runQuery($sql);
    $result->execute();
    $rows = $result->fetchAll( PDO::FETCH_ASSOC );

//Collects Main Banner and Picture
    require('../php/Snoopy.class.php');
    $snoopy = new Snoopy();
    $banner = file_get_contents("https://www.bing.com/images/search?&q=".$tagBanner."&qft=+filterui:aspect-wide+filterui:imagesize-wallpaper");
    $poster = file_get_contents("https://www.bing.com/images/search?q=".$tagBanner."+poster&qft=+filterui:aspect-tall+filterui:imagesize-large&FORM=R5IR2");
    $picture = file_get_contents("https://www.bing.com/images/search?&q=".$tagBanner."&qft=+filterui:imagesize-large+filterui:photo-photo+filterui:aspect-tall&FORM=R5IR28");


} catch (PDOException $pe) {
//Error
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

?>

<html>
<!-- Head -->
<head>
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/fonts.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/header.css">

    <!-- JS -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/functions.js"></script>
    <script src="../../js/magic.js"></script>
    <script src="../../js/facebook-login.js"></script>
    <script src="../../js/api.js"></script>

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="../../owl-carousel/owl.carousel.css">
     
    <!-- Default Theme -->
    <link rel="stylesheet" href="../../owl-carousel/owl.theme.css">

    <!-- Include js plugin -->
    <script src="../../owl-carousel/owl.carousel.js"></script>

    <?php foreach ($rows as $rows1) {} ?>
    <title><?php echo $rows1["article_name"]. ' | Article - AllFunz' ?></title>
    <div class="searchTag"><?php echo $rows1["article_name"]; ?></div>

    <script>
        var tagName = '';
        if ($('.searchTag').text().indexOf('(') >= 0) {
            tagName = $('.searchTag').text().substr(0, $('.searchTag').text().indexOf('(')).trim();
        } else {
            tagName = $('.searchTag').text();
        }

        var amzn_assoc_default_search_phrase = tagName;

    </script>
    
    <!-- Amazon Products -->
    <script type="text/javascript"> amzn_assoc_placement = "adunit0"; amzn_assoc_search_bar = "false"; amzn_assoc_tracking_id = "70f35-20"; amzn_assoc_search_bar_position = "top"; amzn_assoc_ad_mode = "search"; amzn_assoc_ad_type = "smart"; amzn_assoc_marketplace = "amazon"; amzn_assoc_region = "US"; amzn_assoc_title = ""; amzn_assoc_default_search_phrase = amzn_assoc_default_search_phrase; amzn_assoc_default_category = "All"; amzn_assoc_linkid = "d058a796587b75aedb1b52740355e4af";
    </script> 
</head>
<!-- Head | END -->

<!-- Body -->
<body class="articlePage" page-id="<?php echo $rows1["article_id"]; ?>" page-category="<?php echo $rows1["article_category"]; ?>" page-type="<?php echo $rows1["article_page_type"]; ?>">
    <div class="hiddenTag"><?php echo $rows1["article_name"]; ?></div>
    <div class="hiddenDesc"><?php echo $rows1["article_description"]; ?></div>

    <!-- Includes Header -->
    <?php include '../header.php'; ?>    

    <!-- Main Banner -->
    <div class="mainBanner">
        <div class="article info">
            <div class="article category"><?php echo $rows1["article_category"]; ?></div>
            <div class="article name"><?php echo $rows1["article_name"]; ?></div>
        </div>
        <div class="heartMe"></div>
        <ul class="anchor">
            <li class="list" onclick="scrollToElement('#container', 1000);">Information</li>
            <li class="list" onclick="scrollToElement('#videos', 1000);">News</li>
            <li class="list" onclick="scrollToElement('#videos', 1000);">Videos</li>
            <li class="list" onclick="scrollToElement('#amazon_ads', 1000);">Shopping</li>
            <li class="list" onclick="scrollToElement('#videos', 1000);">#SocialMedia</li>
        </ul>
    </div>



    <?php
    if ($_GET['article-id']) {
        if (count($topics) == 0) {
            echo '<p>No topics have been found under the '.$rows1["article_name"].'</a> forum.</p>';
            echo '<br /><br /><a href="../../addtopic.php?forum='.htmlspecialchars($_GET['article-id'],ENT_QUOTES).'">Add Topic</a>';
        } else {
            foreach ($topics as $topic) {
                $topic_id = $topic['id']; //id of topic.
                $topic_title = $topic['title']; //topic title.
                $topic_starter = $topic['starter']; //topic starter.
                $topic_lastpost = $topic['lastpost']; //last replied user
                $totalposts = $forums->totalReplies($topic_id);

                echo '<a href="../../topic.php?id='.$topic_id.'">'.$topic_title.'</a><p>Last post by '.$topic_lastpost.'</p>';
            }
            echo '<br /><a href="../../addtopic.php?forum='.htmlspecialchars($_GET['article-id'],ENT_QUOTES).'">Post new topic</a>';
        }
    }
    ?>




    <!-- Container -->
    <div id="container">


        <!-- Amazon Recommendation Section -->
        <div id="amazon_ads">
            <h2>We found some amazing products related to <strong></strong>:</h2>
            <script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script>
        </div>
    </div>

    <!-- Youtube Section -->
    <div id="videos">
        <h2>videos</h2>
        <div class="videosWrap">
            <div class="iframe">
                <iframe src="" frameborder="0" width="500px" height="300px"></iframe>
            </div>
            <div class="youtube owl-carousel" style="float: left; margin-right: 20px;"></div>
        </div>
        
        <div class="customNavigation">
            <a class="btn prev">Previous</a>
            <a class="btn next">Next</a>
        </div>
       
    </div>
    <script>
        runYoutube();
    </script>

    <!-- Collecting Pages -->
    <div class="fake Banner"><?php echo $banner; ?></div>
    <div class="fake Poster"><?php echo $poster; ?></div>
    <div class="fake Picture"><?php echo $picture; ?></div>


    <script>
    
    /* Picture
    ====================== */
        var pictureUrl = $('.fake.Picture #main a.thumb:eq(0)').attr('href');

    /* Banner selection 
    ====================== */
        var bannerUrl = $('.fake.Banner #main a.thumb:eq(0)').attr('href');
        if (bannerUrl !== undefined) {
            $('.mainBanner').attr('style', 'background-image: url("'+bannerUrl+'"); background-size: 100%;');

            //Insert Banner and picture to DB
            var articleID = $('body').attr('page-id');
            console.log(articleID + ' é o ID dessa pagina');
            $.ajax({
              url: "php/insertArticlePics.php",
              data: { articleID, pictureUrl, bannerUrl },
              type: "GET"
            });
        }

    /*  Amazon name search 
    ==========================*/
    $('#amazon_ads h2 strong').text(tagName);

    /*=============================================
    =           Movies/Television: |Movie Page|  =     
    =============================================*/
    function Movie() {
        $('#container').prepend(
            '<div class="poster">'+
                '<img src="" alt="" />'+
            '</div>'+
            '<div class="trailer">'+
                '<iframe src="" frameborder="0" width="850px" height="430px"></iframe>'+
            '</div>'+
            '<div class="titleArea">'+
                '<div class="category">'+$('body').attr('page-category')+' | </div>'+
                '<div class="name"></div>'+
                '<div class="imdb score"></div>'+
                '<div class="metascore score"></div>'+
            '</div>'+
            '<div class="synopsys"></div>'+
            '<div class="technical_information"></div>'
        );


        //Movie Poster
        var movieName = '';
        if ($('.hiddenTag').text().indexOf('(') >= 0) {
            movieName = $('.hiddenTag').text().substr(0, $('.hiddenTag').text().indexOf('(')).trim().replace(/\ /g, '+');
            //$('.article.name, .titleArea .name').text($('.hiddenTag').text().substr(0, $('.hiddenTag').text().indexOf('(')).trim());
        } else {
            movieName = $('.hiddenTag').text().replace(/\ /g, '+');
            $('.titleArea .name').text($('.hiddenTag').text());
        }
        var movieYear = $('.hiddenDesc').text().match(/(\d{4}(\W))/g)[0].replace(/\D/g,'');
        var urlIMDB = "http://www.omdbapi.com/?t="+movieName+"&y="+movieYear+"&plot=full&r=json";
        $.ajax({
            type: "GET",
            url: urlIMDB,
            dataType: "json",
            success: function(data){
                console.log('URL da Chamada: ', urlIMDB);
                console.log(window.imdb);
                window.imdb = data;
                //Synopsys
                $('.synopsys').append('"' + window.imdb.Plot + '"');

                //Poster
                if (window.imdb.Response == "False" || window.imdb.Poster == "N/A") {
                    var posterURL = $('.fake.Poster #main a.thumb:eq(0)').attr('href');
                    $('.poster img').attr('src', posterURL);
                } else {
                    $('.poster img').attr('src', window.imdb.Poster);
                }

                //Technical information
                $('.technical_information').append(
                    '<ul>'+
                    '<li><strong>Year: </strong>'+window.imdb.Year+'</li>'+
                    '<li><strong>Run Time: </strong>'+window.imdb.Runtime+'</li>'+
                    '<li><strong>Released: </strong>'+window.imdb.Released+'</li>'+
                    '<li><strong>Country: </strong>'+window.imdb.Country+'</li>'+
                    '</ul>'+
                    '<ul class="leader">'+
                    '<li><strong>Director: </strong>'+window.imdb.Director+'</li>'+
                    '<li><strong>Writer: </strong>'+window.imdb.Writer+'</li>'+
                    '<li><strong>Genre: </strong>'+window.imdb.Genre+'</li>'+
                    '</ul>'+
                    '<ul class="leader">'+
                    '<li><strong>Main Cast: </strong>'+window.imdb.Actors+'</li>'+
                    '<li><strong>Awards: </strong>'+window.imdb.Awards+'</li>'+
                    '</ul>'
                );

                //IMDB and Meta score
                $('.titleArea .imdb.score').html('<span>' + window.imdb.imdbRating + '</span>/10');
                $('.titleArea .metascore.score').html('<span>' + window.imdb.Metascore + '</span>/100');
        }
        });



        //Trailer
        var buscaVideo = $('.hiddenTag').text() + " trailer";
        var maxResults = 1;
        var key = "AIzaSyAzI3DknWC6J9MzRJqr0hRF4InBArL_nVk";
        console.log("https://www.googleapis.com/youtube/v3/search?part=id&type=video&q="+buscaVideo+"&maxResults="+maxResults+"&key="+key+"");
        $.ajax({
            type: "GET",
            url: "https://www.googleapis.com/youtube/v3/search?part=id&type=video&q="+buscaVideo+"&maxResults="+maxResults+"&key="+key+"",
            dataType: "json",
            success: function(data){
                window.trailerAPI = data;
                var qntd = window.trailerAPI.items.length;
                var videoID = window.trailerAPI.items[0].id.videoId;
                $('.trailer iframe').attr('src','https://www.youtube.com/embed/'+videoID+'');
                $('.trailer iframe').attr('embed', videoID);

                /*for (var property in window.imdb) {
                if (window.imdb.hasOwnProperty(property)) {
                $('ul.technical_information').append('<li><strong>'+property+': </strong>'+window.imdb[property]+'</li>');
                }
                }*/
            }
        });
    }

    function Movie_Person () {
        $('#container').prepend(
            '<div class="main_picture"><img src="'+pictureUrl+'"/></div>'+
            '<div class="main_info">'+
                '<div class="titleArea">'+
                    '<div class="category">'+$('body').attr('page-category')+' | </div>'+
                    '<div class="name">'+$('.hiddenTag').text()+'</div>'+
                '</div>'+
                '<div class="main_desc">'+$('.hiddenDesc').text()+'</div>'+
            '</div>'
        );
    }

    /*=============================================
    =           Music: |Album Page|  =     
    =============================================*/

    function Album() {
        //Structure
        $('#container').prepend(
            '<div class="main_info">'+
                '<div class="titleArea">'+
                    '<div class="category">'+$('body').attr('page-category')+' | </div>'+
                    '<div class="name">'+$('.hiddenTag').text()+'</div>'+
                '</div>'+
                '<div class="main_tracklist"></div>'+
            '</div>'+
            '<div class="main_picture"><img src=""/></div>'+
            '<div class="main_desc synopsys">"'+$('.hiddenDesc').text()+'"</div>'
        );


        if ($('.article.name').text().indexOf('(') >= 0) {
            var spotifyAlbum = $('.article.name').text().substr(0, $('.article.name').text().indexOf('(')).trim();
        } else {
            var spotifyAlbum = $('.article.name').text().trim();
        }

        var spotifyYear = $('.hiddenDesc').text().match(/(\d{4})/g)[0].trim();
            //Collects albums's ID
            console.log("https://api.spotify.com/v1/search?query="+spotifyAlbum+"+year%3A"+spotifyYear+"+NOT+anniversary+NOT+deluxe+NOT+alben+NOT+edition&offset=0&limit=1&type=album");
            $.ajax({
                type: "GET",
                url: "https://api.spotify.com/v1/search?query="+spotifyAlbum+"+year%3A"+spotifyYear+"+NOT+anniversary+NOT+deluxe+NOT+alben+NOT+edition&offset=0&limit=1&type=album",
                dataType: "html",
                success: function(data){
                    console.log('SPOTIFY!');
                    doc = data;
                    var idAlbum = jQuery.parseJSON(doc);
                    var albumID = idAlbum.albums.items[0].id;
                    var albumCapa = idAlbum.albums.items[0].images[0].url;
                    $('.main_picture img').attr('src', albumCapa);
                    $('.main_picture').after('<div class="spotPlay"><iframe src="https://open.spotify.com/embed?uri=spotify:album:'+albumID+'" frameborder="0" allowtransparency="true" style="width: 400px;height: 80px;"></iframe></div>');

                    //Tracklist
                    $.ajax({
                        type: "GET",
                        url: "https://api.spotify.com/v1/albums/"+albumID+"/tracks?&limit=50",
                        dataType: "html",
                        success: function(data){
                            tracklist = data;
                            var tracklistJSON = jQuery.parseJSON(tracklist);
                            console.log(tracklistJSON);
                            for (i=0; i < tracklistJSON.items.length; i++){
                                var cont = i + 1;
                                $('.main_tracklist').append(
                                '<li>'+
                                    '<span class="tracklistNumber">'+ cont +'</span>'+
                                    '<div class="wrapMusic">'+
                                        '<span class="musicaRank" style="margin-top: 15px; font-weight: normal;"> '+ tracklistJSON.items[i].name +'</span>'+
                                    '</div>'+
                                '</li>');
                            }
                        }
                    });
                }
            });
    }


    /*=============================================
    =           Music: |Song Page|  =     
    =============================================*/

    function Song() {
        //Structure
        $('#container').prepend(
            '<div class="main_info">'+
                '<div class="titleArea">'+
                    '<div class="category">'+$('body').attr('page-category')+' | </div>'+
                    '<div class="name">'+$('.hiddenTag').text()+'</div>'+
                '</div>'+
            '</div>'+
            '<div class="main_lyrics">'+
                '<pre></pre>'+
                '<iframe class="youVideo" width="500" height="320" src="" frameborder="0" allowfullscreen=""></iframe>'+
            '</div>'+

            '<div class="main_desc">'+
                '<div class="main_picture"><img src=""/></div>'+
                $('.hiddenDesc').text()+
            '</div>'
        );

        //names
        var spotifySong = $('.article.name').text().trim();
        var spotifyYear = $('.hiddenDesc').text().match(/(\d{4})/g)[0].trim();
        var chances = 0;

        //Collects albums's ID
        function runSpot(spotifySong, spotifyYear) {
            $.ajax({
                type: "GET",
                url: "https://api.spotify.com/v1/search?query="+spotifySong+"+year%3A"+spotifyYear+"&offset=0&limit=1&type=track",
                dataType: "html",
                success: function(data){
                    doc = data;
                    var idSong = jQuery.parseJSON(doc);

                    if (idSong.tracks.items.length === 0) {
                        chances = chances + 1;
                        if (chances > 10) {
                            return;
                        } else {
                            runSpot(spotifySong, parseInt(spotifyYear) - 1);
                            return;
                        }
                    }
                    
                    var songId = idSong.tracks.items[0].id;
                    var albumCapa = idSong.tracks.items[0].album.images[0].url;
                    var artistName = idSong.tracks.items[0].artists[0].name;
                    console.log(artistName);
                    $('.main_picture img').attr('src', albumCapa);
                    //$('.main_lyrics').append('<div class="spotPlay"><iframe src="https://open.spotify.com/embed?uri=spotify:track:'+songId+'" frameborder="0" allowtransparency="true" style="width: 100%;height: 80px;"></iframe></div>');
                    //Lyrics start
                    jQuery.getJSON(
                        "http://api.vagalume.com.br/search.php"
                        + "?art=" + artistName
                        + "&mus=" + spotifySong,
                        function (data) {
                            // Letra da música
                            setTimeout(function(){
                                if (data.type != 'exact'){
                                    runLyrics2();
                                } else {
                                    $('.main_lyrics pre').html(data.mus[0].text);
                                }
                            },300);
                        }
                    );

                    function runLyrics2(){
                        jQuery.getJSON(
                            "http://api.vagalume.com.br/search.php"
                            + "?art=" + artistName.replace(/&/g,"and")
                            + "&mus=" + spotifySong.replace(/,/g,""),
                            function (data) {
                                $('.letraMusica pre').html(data.mus[0].text);
                                $('.logoParceiro').attr('href', data.mus[0].url);
                            }
                        );
                    }

                    /* YOUTUBE API V3 
                    --------------------*/
                    var searchVideo = artistName + '+-+' + spotifySong;
                    $.ajax({
                        type: "GET",
                        url: "https://www.googleapis.com/youtube/v3/search?part=id&type=video&q="+searchVideo+"&maxResults=20&key=AIzaSyAzI3DknWC6J9MzRJqr0hRF4InBArL_nVk",
                        dataType: "json",
                        success: function(data){
                            videoAPI = data;
                            var videoID = videoAPI.items[0].id.videoId;
                            $('.main_lyrics iframe.youVideo').attr('src','https://www.youtube.com/embed/'+videoID+'');
                        }
                    });
                }
            });
        }
        runSpot(spotifySong, parseInt(spotifyYear) + 1);
    }



    if ($('body[page-type="movie_page"]').length || $('body[page-type="series_page"]').length) {
        Movie();
    } else if ($('body[page-type="artist_page"]').length || $('body[page-type="concert_page"]').length) {
        Movie_Person();
    } else if ($('body[page-type="album_page"]').length) {
        Album();
    } else if ($('body[page-type="song_page"]').length) {
        Song();
    }


    //Remove crawlers
    //$('.fake').remove();
</script>
</body>               
</html>