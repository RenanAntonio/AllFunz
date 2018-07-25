<?php
  try {
    require_once("session.php");
    require_once("class.user.php");
    //Consults DataBase
    $activeDB = new USER();

    if ($_GET){
      //Collects Javascript variables
      $article_name = $_GET['articleName']; 
      $article_description = $_GET['articleDescription'];
      $article_category = $_GET['articleCategory'];
      $article_page_type = $_GET['articlePageType'];
      
      //begins insert
      $insertArticle = $activeDB->runQuery("INSERT INTO article(article_name, article_description, article_category, article_page_type) 
                                                   VALUES(:article_name, :article_description, :article_category, :article_page_type)");        
      $insertArticle->bindparam(":article_name", $article_name);
      $insertArticle->bindparam(":article_description", $article_description);
      $insertArticle->bindparam(":article_category", $article_category);
      $insertArticle->bindparam(":article_page_type", $article_page_type);    
        
      $insertArticle->execute(); 

      //Returs ID of article recently created
      $sqlArticle = "SELECT * FROM article where article_name LIKE '$article_name'";
      $resultArticle = $activeDB->runQuery($sqlArticle);
      $resultArticle->execute();
      $articleFound = $resultArticle->fetchAll( PDO::FETCH_ASSOC );

      foreach ($articleFound as $theArticle) {}
      echo $theArticle["article_id"];
    }
    
    //return $insertArticle; 
  } catch(PDOException $e) {
    //Returs ID of article that already exists
    $sqlArticle = "SELECT * FROM article where article_name LIKE '$article_name'";
    $resultArticle = $activeDB->runQuery($sqlArticle);
    $resultArticle->execute();
    $articleFound = $resultArticle->fetchAll( PDO::FETCH_ASSOC );

    foreach ($articleFound as $theArticle) {}
    echo $theArticle["article_id"];
  }       
?>