<?php 
  function CallImage($articlesParamChecked, $articleNumber) {
    $array = array_slice($articlesParamChecked, 0, $articleNumber);
    $size = sizeof($array);
    for ($i = 0; $i < $size; $i++) {
      $freshString = strtolower(preg_replace('/\s+/', '+', $array[$i]));
      $pictures = file_get_contents("https://www.bing.com/images/search?&q=".$freshString."&qft=+filterui:imagesize-medium+filterui:aspect-tall&FORM=R5IR29&filt=custom");
      echo '<div class="pics" style="display: none !important;">'.$pictures.'</div>';
    }    
  }
  $data = $_POST['articlesParamChecked'];
  $number = $_POST['articleNumber'];
  CallImage($data, $number);
?>