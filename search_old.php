<?php
  try {
    //Requires Pages
    require_once("php/session.php");
    require_once("php/class.user.php");

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
    <title>Funzerz <?php echo ' | "'.$searchTerm.'" - Search '; ?></title>
    <link rel="stylesheet" href="css/search.css">
    <?php include 'head-scripts.html'; ?>
    <script>
      function SaveArticleIfNotExists(articleName, articleDescription, articleCategory, articlePageType) {
        $.ajax({
          url: "php/insertArticle.php",
          data: { articleName, articleDescription, articleCategory, articlePageType },
          type: "GET"
        }).success(function(data) {
          console.log(data);
        });
      }
      function CallImage(queryImage, queryEq) {
        var aaa = '';
        $.getJSON("https://www.googleapis.com/customsearch/v1?key=AIzaSyAzI3DknWC6J9MzRJqr0hRF4InBArL_nVk&&cx=007026239009244781996:uj6k_34ve48&q="+queryImage+"&searchType=image", function(data) {
        aaa = data;
        $('.url:eq('+queryEq+')').after('<img src="'+aaa.items[0].link+'" />');
        });
      }
      function GetDescription(nomeTopico, eqTopico) {
        function Aplica() {
          var data;
          for (var property in window.result.query.pages) {
              if (window.result.query.pages.hasOwnProperty(property)) {
                  data = window.result.query.pages[property].extract;
                  break;
              }
          }
          $('.search_temporary').eq(eqTopico).append('<div class="desc">' + data + '</div>');
        }


        $(document).ready(function(){
          $.ajax({
            type: "GET",
            url: "https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles="+nomeTopico+"&callback=?",
            contentType: "application/json; charset=utf-8",
            async: false,
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                window.result = data;
                Aplica();
            },
            error: function (errorMessage) {
            }
          });
        });
      }

      function AppendInfos() {
        var titles = window.result.query.search;
        for (var i = 0; i < titles.length; i++) {
          $('.container').append(
            '<div class="search_temporary">'+
              '<a class="url" eq="'+i+'"><div class="nome"></div></a>'+
            '</div>');  
          $('.nome:last').append(titles[i].title);
          $('.url:last').attr('href', 'http://en.wikipedia.org/wiki/' + titles[i].title);
        }
        $('.url').each(function(){
          GetDescription($('.url').eq($(this).attr('eq')).text(), $(this).attr('eq'));
          //CallImage($('.url').eq($(this).attr('eq')).text(), $(this).attr('eq'));

        }).promise().done(function(){ 
          setTimeout(function(){
            Magic.FilterTags();
            console.log('Accepted:');
            console.log(' ');
            for (a=0; a< music_clean_result.length; a++) {
              console.log(music_clean_result[a][0], [music_clean_result[a][1]]);
            }
            console.log('--------');
            console.log('Rejected:');
            console.log(' ');
            for (b=0; b< music_waste_result.length; b++) {
              console.log(music_waste_result[b][0], [music_waste_result[b][1]]);
            }
            

            //Insert filtered search
            //$('.search_temporary').remove();
            for (var i = 0; i < music_clean_result.length; i++) {
              //Collects Infos from Article
              var articleName = music_clean_result[i][0].replace('.', ''), articleDescription = music_clean_result[i][1], articleCategory = music_clean_result[i][2], articlePageType = music_clean_result[i][3];
              SaveArticleIfNotExists(articleName, articleDescription, articleCategory, articlePageType);

              if ($('.search_results.first').length < 1) {
                $('.container').append(
                '<div class="search_results first" type="'+articleCategory+'">'+
                  '<div class="avatar"></div>'+
                  '<div style="float: left;">'+
                    '<a class="url" eq="'+i+'" href="'+replaceURL(music_clean_result[i][0])+'"><div class="name">'+articleName+'</div></a>'+
                    '<div class="desc">'+articleDescription+'</div>'+
                  '</div>'+
                '</div>');
              } else {
                $('.container').append(
                '<div class="search_results" type="'+articleCategory+'">'+
                  '<div class="avatar"></div>'+
                  '<div style="float: left;">'+
                    '<a class="url" eq="'+i+'" href="'+replaceURL(music_clean_result[i][0])+'"><div class="name">'+articleName+'</div></a>'+
                    '<div class="desc">'+articleDescription+'</div>'+
                  '</div>'+
                '</div>');
              }
            }
          }, 1000);
        });;
      }


    </script>
  </head>
  <!-- Head | END -->
  <!-- Body -->
  <body class="search_page">
    <span class="hiddenTag" id="queryTerm"><?php echo $searchTerm; ?></span>
    <?php include 'header.php'; ?>
    <div class="container">
    </div>
    <script>
    /*  BUSCA    */
    var termQuery = $('#queryTerm').text();
    var termnLimit = 10;
    $(document).ready(function(){
      $.ajax({
        type: "GET",
        url: "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch="+termQuery+"&srlimit="+termnLimit+"&format=json&callback=?",
        contentType: "application/json; charset=utf-8",
        async: false,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            window.result = data;
            console.log("https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch="+termQuery+"&srlimit="+termnLimit+"&format=json&callback=?");
            AppendInfos();
        },
        error: function (errorMessage) {
        }
      });
    });



     
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script type="text/javascript">
    $(".searchbox").autocomplete({
      source: function(request, response) {
          $.ajax({
              url: "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch="+request.term+"&format=json&callback=?",
              dataType: "jsonp",
              data: {
                  'search': request.term
              },
              success: function(data) {
                console.log(data.query.search);
                response(data.query.search);
              }
          });
      }
    });
</script>
  </body>
</html>






