/* ==========================================================================
   YOUTUBE API V3
   ========================================================================== */

function runYoutube() {
  var buscaVideo = $('.hiddenTag').text();
  var maxResults = 20;
  var key = "AIzaSyAzI3DknWC6J9MzRJqr0hRF4InBArL_nVk";
  $.ajax({
      type: "GET",
      url: "https://www.googleapis.com/youtube/v3/search?part=id&type=video&q="+buscaVideo+"&maxResults="+maxResults+"&key="+key+"",
      dataType: "json",
      success: function(data){
          window.videoAPI = data;
          var qntd = window.videoAPI.items.length;
          var videoID = window.videoAPI.items[0].id.videoId;
          $('#videos iframe').attr('src','https://www.youtube.com/embed/'+videoID+'');
          $('#videos iframe').attr('embed', videoID);
          setTimeout(function(){
            for (var i=0; i < qntd; i++) {
                videoID = window.videoAPI.items[i].id.videoId;
                $('#videos .youtube').append('<img class="carousel_image bgColor" embed="'+videoID+'" style="float: left; margin-right: 10px; margin-bottom: 10px;" src="http://img.youtube.com/vi/'+videoID+'/0.jpg" width="180px" height="150px">');
            }

            $('body').on('click', '.carousel_image', function(){
              var embed = $(this).attr('embed');
              var oldEmbed = $('#videos iframe').attr('embed');
              $('#videos iframe').attr('src', 'https://www.youtube.com/embed/'+embed+'');
              $('#videos iframe').attr('embed', embed);
              $(this).attr('embed', oldEmbed);
              $(this).attr('src', 'http://img.youtube.com/vi/'+oldEmbed+'/0.jpg');
            });

            //start carousel
            var owl = $('#videos .owl-carousel');
            owl.owlCarousel({
              items : 6, //10 items above 1000px browser width
              itemsDesktop : [1000,5], //5 items between 1000px and 901px
              itemsDesktopSmall : [900,3], // betweem 900px and 601px
              itemsTablet: [600,2], //2 items between 600 and 0
              itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
              pagination: false
            });
            $(".next").click(function(){
              owl.trigger('owl.next');
            })
            $(".prev").click(function(){
              owl.trigger('owl.prev');
            });
          }, 1000);
      }
  });
}





/* ==========================================================================
   INSTAGRAM API
   ========================================================================== */

/*function callInstagram($url){
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
    ));

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$tag = 'avengers';
$client_id = "d038b3f86dbe4705a63bd72395e927e8";
$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;

$inst_stream = callInstagram($url);
$results = json_decode($inst_stream, true);

//Now parse through the $results array to display your results... 

foreach($results['data'] as $item){
    $image_link = $item['images']['standard_resolution']['url'];
    $image_link = $item['images']['standard_resolution']['url'];
    echo '<img width="250px" height="250px" src="'.$image_link.'" />';
    echo '<br>';
    echo $item['caption']['text'];
    echo '<br>';
}*/