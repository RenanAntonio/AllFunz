<?php
try {
    //Require Pages
    require_once("php/class.user_demo.php");

    //Consults DataBase
    $activeDB = new USER();

} catch (PDOException $pe) {
    //Error
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

?>

<html>
<!-- Head -->
<head>
    <!-- MetaTags -->
    <title>AllFunz - explore the fun!</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all">
    <meta name="author" content="Renan Antonio">
    <meta name="description" content="AllFunz - explore the fun, discover articles you care about, express your thoughts, meet people who share your interests. Movies, music, sports, games, literature and much more!">
    <meta name="keywords" content="allfunz, fun, entertainment, forum, forums, community, discussion, board, boards, movie, movies, music, series, songs, albums, artists, actors, actresses, directors, bands, sports, basketball, baseball, football, soccer, futebol, player, players, games, game, match, matches, videogames, ps4, xbox, literature, books">


    <!-- CSS -->
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/header.css">

    <!-- JS -->
    <script src="js/jquery.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/magic.js"></script>
    <script src="js/facebook-login.js"></script>
    <script src="js/api.js"></script>

</head>
<!-- Head | END -->

<!-- Body -->
<body class="welcome">
    <!-- Preloads -->
    <div class="a"> <img src="img/bg_main.jpg" alt=""> <img src="img/bg_music.png" alt=""> <img src="img/bg_main2.jpg" alt=""> <img src="img/bg_main3.jpg" alt=""> <img src="img/bg_home_sports.png" alt=""> <img src="img/bg_home_games.png" alt=""> <img src="img/bg_home_literature.png" alt=""> <img src="img/bg_home_movies.png" alt=""> <img src="img/bg_home_music.png" alt=""> <img src="img/bg_home_others.png" alt=""> </div> 

    <div class="backToTop"></div>

    <div class="overlay"></div>
    <form class="subscribe">
        <span class="closeLightbox">x</span>
        <h2>E-mail me when available</h2>
        <input type="text" placeholder="Name" id="name">
        <input type="text" placeholder="E-mail" id="email">
        <div class="join lightbox">Subscribe</div>
    </form>

    <!-- Main Banner -->
    <div class="mainBannerHome first">
        <div class="layer"></div>
        <div class="mobMenu">
            <ul class="menuBar">
                <li class="aboutUs">about us</li>
                <li class="articlesHome">articles</li>
                <li class="contact">contact</li>
            </ul>
        </div>
        <div class="logoHome"></div>
        <h1 class="message">Coming soon!</h1>
        
        <div class="join">E-mail me when available</div>
        <script>
            function SaveEmail(name, email) {
                $.ajax({
                    type: "GET",
                    data: {name, email},
                    url: "php/insertEmail.php",
                    success: function (data) { 
                        console.log(data);
                    }
                });
            }

            $('.subscribe .join.lightbox').click(function(){
                if ($('.subscribe #name').val() !== "" && $('.subscribe #email').val() !== "") {
                    SaveEmail($('.subscribe #name').val(), $('.subscribe #email').val());
                    $('.overlay, .subscribe').fadeOut();
                } else {
                    $('.subscribe input').addClass('error');
                }
            });

            $('.mainBannerHome .join').click(function(){
                $('.overlay, .subscribe').fadeIn();
                $('.menuBar').hide();
            });

            $('.closeLightbox').click(function(){
                $('.overlay, .subscribe').fadeOut();
            });

        </script>
    </div>

    <!-- About us -->
    <div id="aboutUs">
        <h2>About us</h2>
        <p>
            AllFunz connects you with people and content around the things you love. Enjoy an experience that lets you show the world who you are, express what you love, and create meaningful discussions and connections.
        </p>
        <p>
            Gathering in one place all of the important informations of any article in the world is our greatest mission. Let us together create a community surrounded by our thoughts and our passions. Share your mind with the whole world and at the same time, have some fun!
        </p>
        <ul class="spheres">
            <li class="mov"></li>
            <li class="mus"></li>
            <li class="spo"></li>
            <li class="gam"></li>
            <li class="lit"></li>
            <li class="oth"></li>
        </ul>
    </div>

    <!-- Articles -->
    <div id="articlesHome">
        <div class="articles movies active">
            <!-- Movies/Television -->
            <div class="avatar"></div>
            <h2>movies/television</h2>
            <p>Discuss and read about movies, series, actors, actresses, directors and more. All of that in one single place. See what you are missing about the latest news in the film industry.</p>
        </div>
        <!-- Music -->
        <div class="articles music">
            <div class="avatar"></div>
            <h2>music</h2>
            <p>Get to know about the latest releases in the music world. Singles, albums, everything related to your favorite artists is right here waiting for you. Discuss among other fans, listen to music and discover new great sounds.</p>
        </div>
        <!-- Sports -->
        <div class="articles sports">
            <div class="avatar"></div>
            <h2>sports</h2>
            <p>Talk about the latest match from your favorite team. Who is the player everyone is talking about? You're going to find all this and much more. Share with the world how much you love the game!</p>
        </div>
        <!-- Games -->
        <div class="articles games">
            <div class="avatar"></div>
            <h2>games</h2>
            <p>Are you a fan of videogames? Turns out you are not alone. See what game everyone is playing right now, find out about the next releases and much more!</p>
        </div>
        <!-- Literature -->
        <div class="articles literature">
            <div class="avatar"></div>
            <h2>literature</h2>
            <p>Can't wait to talk to someone about the book you just finished reading? You came to the right place. Meet people who share your interests, favorite books and authors.</p>
        </div>
        <!-- Others -->
        <div class="articles others">
            <div class="avatar"></div>
            <h2>others</h2>
            <p>Not everything is entertainment, right? We agree. <br> Politics, culinary, history, science, trips. Literally talk about anything you want in the world.</p>
        </div>

        <ul class="homePagination">
            <li class="mov active"></li>
            <li class="mus"></li>
            <li class="spo"></li>
            <li class="gam"></li>
            <li class="lit"></li>
            <li class="oth"></li>
        </ul>
    </div>

    <!-- Contact -->
    <div id="contact">
        <h2>Contact</h2>
        <a href="mailto:contact@allfunz.com" target="_blank">
            <label class="contact_icon mail"><span>Send a message</span></label>
        </a>
        <a href="http://www.facebook.com/allfunz" target="_blank">
            <label class="contact_icon face"><span>Like our Facebook page</span></label>
        </a>
        <a href="http://www.instagram.com/allfunz" target="_blank">
            <label class="contact_icon insta"><span>Follow our Instagram</span></label>
        </a>
        
    </div>

    <div id="bottom">© 2017 AllFunz</div>

    <script>
        //Change Articles
        $('body').on('click', '.homePagination li', function(){var newArticle = $(this).attr('class'); if (newArticle === "mov" && !$('.homePagination li.active').hasClass('mov')) {$('.articles').removeClass('active'); $('.homePagination li').removeClass('active'); $('.articles').eq(0).addClass('active'); $('#articlesHome').css('background-image', 'url(img/bg_home_movies.png)'); $(this).addClass('active'); } else if (newArticle === "mus" && !$('.homePagination li.active').hasClass('mus')) {$('.articles').removeClass('active'); $('.homePagination li').removeClass('active'); $('.articles').eq(1).addClass('active'); $('#articlesHome').css('background-image', 'url(img/bg_home_music.png)'); $(this).addClass('active'); } else if (newArticle === "spo" && !$('.homePagination li.active').hasClass('spo')) {$('.articles').removeClass('active'); $('.homePagination li').removeClass('active'); $('.articles').eq(2).addClass('active'); $('#articlesHome').css('background-image', 'url(img/bg_home_sports.png)'); $(this).addClass('active'); } else if (newArticle === "gam" && !$('.homePagination li.active').hasClass('gam')) {$('.articles').removeClass('active'); $('.homePagination li').removeClass('active'); $('.articles').eq(3).addClass('active'); $('#articlesHome').css('background-image', 'url(img/bg_home_games.png)'); $(this).addClass('active'); } else if (newArticle === "lit" && !$('.homePagination li.active').hasClass('lit')) {$('.articles').removeClass('active'); $('.homePagination li').removeClass('active'); $('.articles').eq(4).addClass('active'); $('#articlesHome').css('background-image', 'url(img/bg_home_literature.png)'); $(this).addClass('active'); } else if (newArticle === "oth" && !$('.homePagination li.active').hasClass('oth')) {$('.articles').removeClass('active'); $('.homePagination li').removeClass('active'); $('.articles').eq(5).addClass('active'); $('#articlesHome').css('background-image', 'url(img/bg_home_others.png)'); $(this).addClass('active'); } });

        //Menu Scroll
        $(".menuBar li").click(function() {
            var newId = $(this).attr('class');
            $('html, body').animate({
                scrollTop: $("#"+newId).offset().top
            }, 1500);
        });

        //Menu Mobile
        if ($('.menuBar:visible').length < 1) {
            $(".mobMenu").click(function() {
                if ($('.menuBar:visible').length) {
                    $('.menuBar').slideUp();
                } else {
                    $('.menuBar').slideDown();
                }
            });
        }

        //Banner rotation
        var wall = ['first','second', 'third', 'fourth'];
        var messages = ["explore the fun", "discover articles you care about", "express your thoughts", "meet people who share your interests"];

        function Banner() {
            setTimeout(function(){$('.mainBannerHome').removeClass(wall[0]).addClass(wall[1]); /*$('.message').text(messages[1]);*/ setTimeout(function(){$('.mainBannerHome').removeClass(wall[1]).addClass(wall[2]); /*$('.message').text(messages[2]);*/ setTimeout(function(){$('.mainBannerHome').removeClass(wall[2]).addClass(wall[3]); /*$('.message').text(messages[3]);*/ setTimeout(function(){$('.mainBannerHome').removeClass(wall[3]).addClass(wall[0]); /*$('.message').text(messages[0]);*/ Banner(); }, 6000); }, 6000); }, 6000); }, 6000); }
        //run function
        Banner();


        //Back to top
        $('.backToTop').click(function(){
            $('html, body').animate({
                scrollTop: $('html, body').offset().top
            }, 800);
        });
        

    </script>
</body>               
</html>