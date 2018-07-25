<?php
  try {
    //Requires Pages
    require_once("php/session.php");
    require_once("php/class.user.php");

    //Consults DataBase
    $activeDB = new USER();

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
    <title><?php echo ' | Search: '.$searchTerm ?></title>
    <?php include 'head-scripts.html'; ?>
    <script>
      function ChamaDescricao(nomeTopico, eqTopico) {
          console.log(nomeTopico);
          function Aplica() {
              var data;
              for (var property in window.result.query.pages) {
                  if (window.result.query.pages.hasOwnProperty(property)) {
                      data = window.result.query.pages[property].extract;
                      break;
                  }
              }
              $('.wiki').eq(eqTopico).append(data);
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

      function AppendInfos(limite) {
        for (i=0; i<limite; i++) {
          $('.container').append(
            '<div class="wiki">'+
              '<div class="url" eq="'+i+'" target="_blank"><a href="'+window.result[3][i]+'" target="_blank"><div class="nome">'+window.result[1][i]+'</div></a></div>'+
              '<div class="desc">'+window.result[2][i]+'</div>'+
            '</div>');  
        }
      }


    </script>
  </head>
  <!-- Head | END -->
  <!-- Body -->
  <body>
    <span class="hidden-tag" id="queryTerm"><?php echo $searchTerm; ?></span>
    <?php include 'header.php'; ?>
    <div class="container">
    </div>
    <script>
    /*  BUSCA    */
    var termQuery = $('#queryTerm').text();
    var termnLimit = 20;
    $(document).ready(function(){
      $.ajax({
        type: "GET",
        //url: "https://en.wikipedia.org/w/api.php?action=opensearch&search="+termQuery+"&limit="+termnLimit+"&format=json",
        url: "https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch="+termQuery+"&srlimit="+termnLimit+"&format=json&callback=?",
        contentType: "application/json; charset=utf-8",
        async: false,
        dataType: "jsonp",
        success: function (data, textStatus, jqXHR) {
            window.result = data;
            console.log(window.result);
            AppendInfos(termnLimit);
        },
        error: function (errorMessage) {}
      });

    });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script type="text/javascript">
    $(".searchbox").autocomplete({
      source: function(request, response) {
          console.log(request.term);
          $.ajax({
              url: "http://en.wikipedia.org/w/api.php",
              dataType: "jsonp",
              data: {
                'action': "opensearch",
                'format': "json",
                'search': request.term
              },
              success: function(data) {
                console.log(data);
                response(data[1]);
              }
          });
      }
    });
</script>
  </body>
</html>






