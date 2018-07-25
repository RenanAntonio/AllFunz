<?php
  try {
    //require_once("session.php");
    require_once("class.user_demo.php");
    //Consults DataBase
    $activeDB = new USER();

    if ($_GET){
      //Collects Javascript variables
      $name = $_GET['name']; 
      $email = $_GET['email'];

      //begins insert
      $insertArticle = $activeDB->runQuery("INSERT INTO subscribe(name, email) 
                                                   VALUES(:name, :email)");        
      $insertArticle->bindparam(":name", $name);
      $insertArticle->bindparam(":email", $email);
        
      $insertArticle->execute(); 
    }
    
    //return $insertArticle; 
  } catch(PDOException $e) {
    echo $e->getMessage();
  }       
?>