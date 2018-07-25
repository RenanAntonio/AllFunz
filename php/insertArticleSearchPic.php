<?php
  try {
    require_once("session.php");
    require_once("class.user.php");
    //Consults DataBase
    $activeDB = new USER();

    if ($_GET){
      //Collects Javascript variables
      $article_name = $_GET['name']; 
      $article_picture_search = $_GET['image']; 

      //begins insert
      $insertArticle = $activeDB->runQuery("UPDATE article SET article_picture_search = '$article_picture_search' WHERE article_name = '$article_name'");        
      $insertArticle->bindparam(":article_picture_search", $article_picture_search);
        
      $insertArticle->execute(); 

    }
    
  } catch(PDOException $e) {
    echo "<script>alert('dssasdsasda');</script>";
  }       
?>