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


    //Collects Topics
    $sql = "SELECT * FROM article";
    $result = $activeDB->runQuery($sql);
    //$rows = $result->fetchAll( PDO::FETCH_ASSOC );
    $result->execute();
    $articles = $result->fetchAll(PDO::FETCH_ASSOC);


  } catch (PDOException $pe) {
    //Error
    die("Could not connect to the database $dbname :" . $pe->getMessage());
  }

?>
<html>
    <!-- Head -->
    <head>
        <title><?php echo $userRow['user_name']; ?> | AllFunz</title>
        <?php include 'head-scripts.html'; ?>
    </head>
    <!-- Head | END -->
    <!-- Body -->
    <body>
        <?php include 'header.php'; ?>
        <div class="container profile">
            <div class="leftFixed">
                <div class="posts">
                    <a href="/allfunz/profile">
                        <img src="http://graph.facebook.com/<?php echo $userRow['user_logger'] ?>/picture?width=150&height=150" />
                        <span class="name"><?php echo $userRow['user_name']; ?></span>
                    </a>
                    <div class="tech">
                        <span class="info"><b>• Moderated forums:</b> 0</span>
                        <span class="info"><b>• Posts:</b> 75</span>
                        <span class="info"><b>• Replies:</b> 3,425</span>
                        <span class="info"><b>• E-mail:</b> <?php print($userRow['user_email']); ?></span>
                        <span class="info"><b>• User since:</b> <?php print($userRow['joining_date']); ?></span>
                        <div class="logout"><a href="/allfunz/logout.php?logout=true">Logout</a></div>
                    </div>
                </div>
            </div>
            <div class="rightPosts">
                <h2 class="title">Your Recent Posts</h2>
                <div class="recentPost">
                <?php 
                    foreach ($articles as $lines){
                      $name = strtr($lines['article_name'], $normalizeChars);
                      $nameFormatted = clean($name);
                      $currentColor = colorArticle($lines['article_category']);
                      echo '<div class="post">
                                <div class="top">
                                    <a href="article/'.$lines['article_id'].'/'.$nameFormatted.'.html">
                                        <div class="article_img '.$currentColor.'" style="background-image: url('.$lines['article_picture'].');"></div>
                                        <div class="wrap">
                                            <span class="category '.$currentColor.'">'.$lines['article_category'].'</span>
                                            <span class="article">'.$lines['article_name'].'</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="author"><a href="">Renan Antonio</a><span>posted:</span></div>
                                    <div class="message">“Do you guys think Leo should had won the Oscars for best actor instead of Matthew? I personally think Matt did a way better job in Dallas...”</div>
                                    <div class="visit"><a href="article/'.$lines['article_id'].'/'.$nameFormatted.'.html">Visit forum</a></div>
                                </div>
                            </div>';
                    } 
                ?>
                </div>
            </div>
        </div>
    
    <script>
        /*$('.container .articles li a').each(function(){
          var oldLink = $(this).attr('href');
          $(this).attr('href', replaceURL(oldLink));
        });*/
    </script>
  
    <!-- Bottom -->
    <?php
        include 'bottom.php';
    ?>

    <!-- Body | END -->
    </body>
</html>




