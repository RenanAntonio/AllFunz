<?php 
  require_once("session.php");
  require_once("class.user.php");
  $activeDB = new USER();

  if ($_GET) {
    $articlesParam = $_GET['articlesParam'];
    $size = sizeof($articlesParam);
    for ($i = 0; $i < $size; $i++) {
      //Returs image of article that already exists
      $sqlArticle = "SELECT * FROM article where article_name LIKE '$articlesParam[$i]'";

      $resultArticle = $activeDB->runQuery($sqlArticle);
      $resultArticle->execute();
      $articleFound = $resultArticle->fetchAll( PDO::FETCH_ASSOC );
      if (sizeof($articleFound) > 0) {
        if ($articleFound[0]["article_picture"] !== "") {
          echo '<div class="checkedImages">
                  <div class="name">'.$articleFound[0]["article_name"].'</div>
                  <div class="img">'.$articleFound[0]["article_picture"].'</div>
                </div>';

        } else if ($articleFound[0]["article_picture_search"] !== "") {
          echo '<div class="checkedImages">
                  <div class="name">'.$articleFound[0]["article_name"].'</div>
                  <div class="img">'.$articleFound[0]["article_picture_search"].'</div>
                </div>';
        }
      }
    }    
  }
  
?>