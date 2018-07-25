<?php
  try {
    //Requires Pages
    require_once("php/session.php");
    require_once("php/class.user.php");
    require('php/Snoopy.class.php');
    $snoopy = new Snoopy();

    //Consults DataBase
    $activeDB = new USER();

    //Gets User Info
    if (isset($_SESSION['user_session'])) {
      $user_id = $_SESSION['user_session'];
      $stmt = $activeDB->runQuery("SELECT * FROM users WHERE user_id=:user_id");
      $stmt->execute(array(":user_id"=>$user_id));
      
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    }


    //Collect from URL
    $searchTerm = $_GET['query'];


  } catch (PDOException $pe) {
    //Error
    die("Could not connect to the database $dbname :" . $pe->getMessage());
  }

?>
<html>
    <!-- Head -->
    <head>
        <title>Search for <?php echo $searchTerm; ?> | AllFunz</title>
        <?php include 'head-scripts.html'; ?>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <style>
          html { display: inline-grid; }
        </style>
    </head>
    <!-- Head | END -->
    <!-- Body -->
    <body>
        <?php include 'header.php'; ?>
        <span class="hiddenTag" id="queryTerm"><?php echo $searchTerm; ?></span>
        <div class="container search">
            <div class="search_title">
                <h2 class="title">Your search for <b>"<?php echo $searchTerm; ?>"</b></h2>
                <div class="filter">
                  <span class="info">Filter:</span>
                  <ul class="spheres">
                      <li class="movies active">movies/television</li>
                      <li class="music active">music</li>
                      <li class="sport active">sports</li>
                      <li class="games active">games</li>
                      <li class="literature active">literature</li>
                      <li class="others active">others</li>
                  </ul>
                </div>
            </div>
            <div class="loading">
                <div class="bubbles" id="b1"></div>
                <div class="bubbles" id="b2"></div>
                <div class="bubbles" id="b3"></div>
                <div class="bubbles" id="b4"></div>
                <div class="bubbles" id="b5"></div>
            </div>
        </div>
    
    <!-- Bottom -->
    <?php
        include 'bottom.php';
    ?>

    <script>  
        /*  BUSCA    */
        var termQuery = $('#queryTerm').text();
        var termnLimit = 50;
        $(document).ready(function(){
          $.ajax({
            type: "GET",
            url: "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch="+termQuery+"&srlimit="+termnLimit+"&format=json&callback=?",
            contentType: "application/json; charset=utf-8",
            async: false,
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                window.result = data;
                AppendInfos();
            },
            error: function (errorMessage) {
            }
          });
        });

        //AutoComplete
        $(".searchbox").autocomplete({
          source: function(request, response) {
              $.ajax({
                  url: "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch="+request.term+"&format=json&callback=?",
                  dataType: "jsonp",
                  data: {
                      'search': request.term
                  },
                  success: function(data) {
                    response(data.query.search);
                  }
              });
          }
        });

        //Load More
        $('body').on('click', '.loadMore', function(){
            $('.loadMore').remove();
            $('.search_results:not(visible)').fadeIn(1500);
        });


        //Collects images
        function Pictures(qntPics){
          //var qntPics = $('.pics').length;
          var pic = 0;
          var image = $('.pics:not(.ready):eq('+pic+') #main a.thumb:eq(0)').attr('href');
          var name = $('.search_results:not(.ready, .checked):eq('+pic+') .name').text();
          //Aplies images
          if (image != undefined) {
            $('.search_results:not(.ready, .checked):eq('+pic+') .avatar').attr('style','background-image: url('+image+')');
          }
          $('.search_results:not(.ready, .checked):eq('+pic+')').addClass('ready');
          $('.pics:not(.ready):eq('+pic+')').addClass('ready');

          //Save images on pictures_search
          var newSearchPic = $.ajax({
              type: "GET",
              url: "./php/insertArticleSearchPic.php",
              global: false,
              async:false,
              data: { name, image },
              success: function (response) {
                if (articlesParamChecked.length > 0) {
                  ApplyImages();
                } else {
                  $('.hiddenImg').remove();
                  console.log('end of articles');
                }
              }
          }).responseText;
          return newSearchPic;
        }

        //Call Images
        var qntPics = 1;
        var articlesParam = [], articlesParamChecked = [];
        function ApplyImages () {
          $.post( "php/callImage.php", { articlesParamChecked: articlesParamChecked, articleNumber : qntPics }, function(json) {
            $("body .hiddenImg").append(json);
            $('.hiddenImg style').remove();
          });
          articlesParamChecked.splice(0, qntPics);
          var waitPics = setInterval(function(){
            if ($('.pics:not(.ready)').length > 0) {
              clearInterval(waitPics);
              Pictures(qntPics);
            }
          }, 100);
          setTimeout(function(){
            clearInterval(waitPics);
          }, 10000);
        }

        //Check if article has image on DB
        function CheckImages (articlesParam) {
          var checking = $.ajax({
              type: "GET",
              url: "php/checkImage.php",
              global: false,
              async:false,
              data: { articlesParam },
              success: function (response) {
                $("body .checkedImg").append(response);
                $('.checkedImg .checkedImages').each(function(index){
                  var eqDBImg = $('.checkedImg .checkedImages:eq('+index+')');
                  $('.search_results').each(function(){
                    if ($(this).find('.name').text() === eqDBImg.find('.name').text()) {
                      $(this).find('.avatar').attr('style','background-image: url('+eqDBImg.find('.img').text()+')');
                      $(this).addClass('checked');
                    }
                  });
                });
                //Remove images
                $('.checkedImg').remove();

                //Run function to get missed images
                $('.search_results:not(.checked) .name').each(function(){
                  articlesParamChecked.push($(this).text());
                });
                ApplyImages();
              }
          }).responseText;
          return checking;
        }

        var waitResults = window.setInterval(function(){
          if ($('.search_results').length > 0) {
            clearInterval(waitResults);
            $('.search_results .name').each(function(){
              articlesParam.push($(this).text());
            });
            //Run function to check if has images
            CheckImages(articlesParam);
            
          }
        }, 1000);
        
    </script>

    <div class="hiddenImg"></div>
    <div class="checkedImg"></div>
    <!-- Body | END -->
    </body>
</html>




