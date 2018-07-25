<?php
  try {
    require_once("session.php");
    require_once("class.user.php");
    //Consults DataBase
    $activeDB = new USER();

    if ($_GET){
      //Collects Javascript variables
      $article_id = $_GET['articleID']; 
      $article_picture = $_GET['pictureUrl']; 
      $article_banner = $_GET['bannerUrl']; 

      //begins insert
      $insertArticle = $activeDB->runQuery("UPDATE article SET article_picture = '$article_picture', article_banner = '$article_banner' WHERE article_id = '$article_id'");        
      $insertArticle->bindparam(":article_picture", $article_picture);
      $insertArticle->bindparam(":article_banner", $article_banner);
        
      $insertArticle->execute(); 
    }
    
    //return $insertArticle; 
  } catch(PDOException $e) {
    echo $e->getMessage();
  }       
?>